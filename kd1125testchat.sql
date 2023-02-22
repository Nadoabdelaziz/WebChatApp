-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 16. Jan 2023 um 03:16
-- Server-Version: 10.5.18-MariaDB-0+deb11u1
-- PHP-Version: 8.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `kd1125testchat`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `conversations`
--

CREATE TABLE `conversations` (
  `conversation_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `conversations`
--

INSERT INTO `conversations` (`conversation_id`, `sender_id`, `receiver_id`) VALUES
(8, 1234, 1337),
(2, 1337, 1111),
(7, 11111, 1111),
(1, 11111, 1234);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `messages`
--

INSERT INTO `messages` (`id`, `message`, `sender_id`, `receiver_id`, `time_stamp`, `seen`) VALUES
(1, 'Ym8zYThEcHhibTNiSTRvb2oxaVJBQT09', 11111, 1111, '2023-01-16 02:01:16', 0),
(2, 'ZHFrV01GNVNiVHhnVURrazRSa1VjZz09', 1234, 11111, '2023-01-16 02:09:58', 0),
(3, 'M1FZanozNU1UOW01MHIxWVFCSzZYUT09', 1234, 1337, '2023-01-16 02:10:40', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `user_id`, `password`, `name`) VALUES
(1, 1111, '$2y$10$27ZcGHkP/I1sM83NHCjazeMXfmOfIuu1YezDCKtNg0SGActjWXtom', NULL),
(2, 1234, '$2y$10$8/a1YDG2CafMOz5GF5wUCe10PH4ls.ORSix6WbjC1YI9dbc2vAsY.', NULL),
(3, 11111, '$2y$10$FN7elPXOn0jDeoa4KOPRZ.x1mYZaKE2aBNgS3L9HrZToReSvlRAP6', NULL),
(4, 111115, '$2y$10$mAOOav7J/vyKWLK0Frwrye0a3YpyghtlRWwH98UlgovdgZ1.jIZk6', NULL),
(5, 111118, '$2y$10$hQLElPPYZPGKolMFLuFNNuptJ36gOs4Y8WmWt0rcKYdZIg8d9LYbO', NULL),
(6, 4545, '$2y$10$rukduQCHZzf3maoJjFv37uCRnWFGyGcN2EeTajPd6UiuwFHlsyAI.', NULL),
(7, 1337, '$2y$10$qBSzwdiGz5rVljHPBR9wROyYAlV5wqlMNQ9kJEtQI89yZge8EQTR.', NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`),
  ADD UNIQUE KEY `sender_id` (`sender_id`,`receiver_id`);

--
-- Indizes für die Tabelle `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `conversations`
--
ALTER TABLE `conversations`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
