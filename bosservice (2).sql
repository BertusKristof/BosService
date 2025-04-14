-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Gép: localhost:3306
-- Létrehozás ideje: 2025. Ápr 14. 13:59
-- Kiszolgáló verziója: 5.7.24
-- PHP verzió: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `bosservice`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `contact_name` varchar(200) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `appointment_service` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` varchar(2000) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `contact_name`, `appointment_service`, `appointment_date`, `appointment_time`) VALUES
(23, 'Bertus   Kristóf', 'Olajcsere', '2025-04-18', '13:00');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `contact_name` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `license_plate` varchar(15) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `brand` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `model` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `cars`
--

INSERT INTO `cars` (`car_id`, `contact_name`, `license_plate`, `brand`, `model`, `year`) VALUES
(23, 'Bertus   Kristóf', 'ABC-111', 'Volkswagen', 'Bora', 1999);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `position` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `employees`
--

INSERT INTO `employees` (`employee_id`, `name`, `position`) VALUES
(1, 'Kovács Béla', 'olajcsere'),
(2, 'Szabó István', 'motorjavitás'),
(3, 'László Antal', 'autókarbantartó'),
(4, 'Bíró Péter', 'egyéb');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2025_03_02_152014_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AppModelsuser_login',
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(3, 'App\\Models\\user_register', 23, 'authToken', '5a4b32a55998b66f70a7336f8f1e3842ff94cde4f6f16e9ce25edf353902a8fe', '[\"*\"]', NULL, NULL, '2025-04-14 11:01:03', '2025-04-14 11:01:03');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_login`
--

CREATE TABLE `user_login` (
  `login_id` int(11) NOT NULL,
  `login_email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `login_phone` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `login_password` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `user_login`
--

INSERT INTO `user_login` (`login_id`, `login_email`, `login_phone`, `login_password`) VALUES
(23, 'kristofbertus@gmail.com', '06701234567', '$2y$12$zkDGcT8y7sJ42cPQ3uSq6OLSoo4Lna.NPTMhJhJCVG4mxpab0O7VG');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_register`
--

CREATE TABLE `user_register` (
  `register_id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `register_email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `register_phone` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `register_password` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `user_register`
--

INSERT INTO `user_register` (`register_id`, `first_name`, `last_name`, `register_email`, `register_phone`, `register_password`) VALUES
(23, 'Bertus', 'Kristóf', 'kristofbertus@gmail.com', '06701234567', '$2y$12$zkDGcT8y7sJ42cPQ3uSq6OLSoo4Lna.NPTMhJhJCVG4mxpab0O7VG');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- A tábla indexei `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`);

--
-- A tábla indexei `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- A tábla indexei `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `login_email` (`login_email`),
  ADD UNIQUE KEY `login_phone` (`login_phone`);

--
-- A tábla indexei `user_register`
--
ALTER TABLE `user_register`
  ADD PRIMARY KEY (`register_id`),
  ADD UNIQUE KEY `register_email` (`register_email`),
  ADD UNIQUE KEY `register_phone` (`register_phone`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT a táblához `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT a táblához `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `user_login`
--
ALTER TABLE `user_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT a táblához `user_register`
--
ALTER TABLE `user_register`
  MODIFY `register_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
