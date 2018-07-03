-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2018 at 08:27 PM
-- Server version: 5.6.33
-- PHP Version: 7.0.12
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Database: `game_app_finder`
--
-- --------------------------------------------------------
--
-- Table structure for table `all_info`
--
CREATE TABLE `all_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `description`
--
CREATE TABLE `description` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `translated_description` text NOT NULL,
  `game_app_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `expand_details`
--
CREATE TABLE `expand_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `icon_url` varchar(255) NOT NULL,
  `video_urls_id` int(11) NOT NULL,
  `screenshot_urls_id` int(11) NOT NULL,
  `whats_new` varchar(255) NOT NULL,
  `game_app_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `game_app`
--
CREATE TABLE `game_app` (
  `id` int(10) UNSIGNED NOT NULL,
  `bundle_id ` varchar(255) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `genre_index` int(11) NOT NULL,
  `publisher_index` int(11) NOT NULL,
  `description_id` int(11) NOT NULL,
  `rating_id` int(11) NOT NULL,
  `app_type_id` int(11) NOT NULL,
  `price` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `recommend_id` int(11) NOT NULL,
  `expand_detail_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `publisher`
--
CREATE TABLE `publisher` (
  `id` int(10) UNSIGNED NOT NULL,
  `publisher_id` varchar(255) NOT NULL,
  `publisher_name` varchar(255) NOT NULL,
  `publisher_email` varchar(255) NOT NULL,
  `publisher_address` varchar(255) NOT NULL,
  `publisher_url` varchar(255) NOT NULL,
  `release_date` varchar(50) NOT NULL,
  `game_app_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `purchases`
--
CREATE TABLE `purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `price` varchar(100) NOT NULL,
  `store_url` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_app_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `rating`
--
CREATE TABLE `rating` (
  `id` int(10) UNSIGNED NOT NULL,
  `all_rating` decimal(10,0) NOT NULL,
  `all_rating_count` int(11) NOT NULL,
  `game_app_id` int(11) NOT NULL,
  `downloads` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `recommed`
--
CREATE TABLE `recommed` (
  `id` int(10) UNSIGNED NOT NULL,
  `related_apps` varchar(255) NOT NULL,
  `game_app_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `screenshot_urls`
--
CREATE TABLE `screenshot_urls` (
  `id` int(10) UNSIGNED NOT NULL,
  `screenshot_urls` varchar(255) NOT NULL,
  `game_app_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `video_urls`
--
CREATE TABLE `video_urls` (
  `id` int(10) UNSIGNED NOT NULL,
  `video_urls` varchar(255) NOT NULL,
  `game_app_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `wiz_answers`
--
CREATE TABLE `wiz_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `answers` varchar(255) NOT NULL,
  `wiz_questions_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `wiz_questions`
--
CREATE TABLE `wiz_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `questions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Indexes for dumped tables
--
--
-- Indexes for table `all_info`
--
ALTER TABLE `all_info`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `description`
--
ALTER TABLE `description`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `expand_details`
--
ALTER TABLE `expand_details`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `game_app`
--
ALTER TABLE `game_app`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `recommed`
--
ALTER TABLE `recommed`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `screenshot_urls`
--
ALTER TABLE `screenshot_urls`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `video_urls`
--
ALTER TABLE `video_urls`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `wiz_answers`
--
ALTER TABLE `wiz_answers`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `wiz_questions`
--
ALTER TABLE `wiz_questions`
  ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `all_info`
--
ALTER TABLE `all_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `description`
--
ALTER TABLE `description`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expand_details`
--
ALTER TABLE `expand_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `game_app`
--
ALTER TABLE `game_app`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `recommed`
--
ALTER TABLE `recommed`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `screenshot_urls`
--
ALTER TABLE `screenshot_urls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `video_urls`
--
ALTER TABLE `video_urls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wiz_answers`
--
ALTER TABLE `wiz_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wiz_questions`
--
ALTER TABLE `wiz_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;