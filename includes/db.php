<?php
/**
 * Database connection (PDO MySQL singleton).
 * Auto-create tables if not exist (graceful first-run).
 */

declare(strict_types=1);

global $DB_CONN;

function db(): PDO
{
    global $DB_CONN;
    if ($DB_CONN instanceof PDO) {
        return $DB_CONN;
    }

    global $DB;
    $dsn = "mysql:host={$DB['host']};dbname={$DB['name']};charset={$DB['charset']}";

    try {
        $DB_CONN = new PDO($dsn, $DB['user'], $DB['pass'], [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$DB['charset']} COLLATE utf8mb4_unicode_ci",
        ]);
    } catch (PDOException $e) {
        // Graceful fallback — write to log, render a friendly message
        error_log('[DB] ' . $e->getMessage());
        http_response_code(500);
        if (DEBUG_MODE) {
            die('Database connection failed: ' . htmlspecialchars($e->getMessage()));
        }
        die('Maaf, sistem sedang mengalami gangguan. Coba beberapa saat lagi atau hubungi kami via WhatsApp.');
    }

    return $DB_CONN;
}

/**
 * Pastikan semua tabel ada. Dipanggil sekali di bootstrap.
 */
function db_ensure_schema(): void
{
    try {
        $pdo = db();
        $pdo->exec("CREATE TABLE IF NOT EXISTS `leads` (
            `id`            CHAR(24)    NOT NULL,
            `name`          VARCHAR(255) NOT NULL,
            `phone`         VARCHAR(64) NOT NULL,
            `model`         VARCHAR(64) NULL,
            `interest`      VARCHAR(32) NOT NULL DEFAULT 'general',
            `area`          VARCHAR(128) NULL,
            `preferred_date` VARCHAR(32) NULL,
            `message`       TEXT NULL,
            `lang`          CHAR(2)     NOT NULL DEFAULT 'id',
            `source`        VARCHAR(64) NOT NULL DEFAULT 'website',
            `status`        VARCHAR(32) NOT NULL DEFAULT 'new',
            `ip`            VARCHAR(64) NULL,
            `user_agent`    VARCHAR(255) NULL,
            `created_at`    DATETIME    NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            KEY `idx_status_created` (`status`, `created_at`),
            KEY `idx_model` (`model`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $pdo->exec("CREATE TABLE IF NOT EXISTS `reviews` (
            `id`            CHAR(24)    NOT NULL,
            `model_id`      VARCHAR(64) NOT NULL,
            `name`          VARCHAR(255) NOT NULL,
            `city`          VARCHAR(128) NULL,
            `rating`        TINYINT     NOT NULL DEFAULT 5,
            `comment`       TEXT NOT NULL,
            `published`     TINYINT(1)  NOT NULL DEFAULT 0,
            `created_at`    DATETIME    NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            KEY `idx_model_published` (`model_id`, `published`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $pdo->exec("CREATE TABLE IF NOT EXISTS `chat_logs` (
            `id`            BIGINT      NOT NULL AUTO_INCREMENT,
            `session_id`    VARCHAR(64) NULL,
            `lang`          CHAR(2)     NOT NULL DEFAULT 'id',
            `user_msg`      TEXT NULL,
            `bot_reply`     TEXT NULL,
            `ip`            VARCHAR(64) NULL,
            `created_at`    DATETIME    NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            KEY `idx_session` (`session_id`),
            KEY `idx_created` (`created_at`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    } catch (Throwable $e) {
        error_log('[DB schema] ' . $e->getMessage());
    }
}

/**
 * CUID-like ID generator (24 chars).
 */
function db_id(): string
{
    return bin2hex(random_bytes(12));
}
