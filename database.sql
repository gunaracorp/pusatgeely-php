-- ════════════════════════════════════════════════════════════════
--  PUSAT GEELY — MySQL Schema
--  Import file ini via cPanel → phpMyAdmin → database kamu → tab Import
-- ════════════════════════════════════════════════════════════════

SET NAMES utf8mb4;
SET time_zone = '+07:00';
SET sql_mode = 'STRICT_ALL_TABLES';

-- ─────────────────────────────────────────────────────────────────
--  Table: leads
-- ─────────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `leads` (
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
    KEY `idx_model` (`model`),
    KEY `idx_phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────────────────────────
--  Table: reviews
--  published = 0 (pending) | 1 (approved) — di-moderasi via admin
-- ─────────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `reviews` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────────────────────────
--  Table: chat_logs (opsional — untuk audit Geely Bot)
-- ─────────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `chat_logs` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────────────────────────
--  Seed: contoh review approved (opsional — bisa dihapus)
-- ─────────────────────────────────────────────────────────────────
-- INSERT INTO `reviews` (`id`, `model_id`, `name`, `city`, `rating`, `comment`, `published`) VALUES
-- ('seed01', 'ex5', 'Budi', 'Bogor', 5, 'Pelayanan ramah, EX5 nyaman dipakai harian.', 1);

-- ════════════════════════════════════════════════════════════════
--  DONE — schema ready. Pastikan config.php $DB match dengan DB ini.
-- ════════════════════════════════════════════════════════════════
