-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 20-Fev-2015 às 15:02
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gestaointegrada`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `canvas_project`
--

CREATE TABLE IF NOT EXISTS `canvas_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gp` varchar(255) NOT NULL,
  `pitch` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `canvas_ticket`
--

CREATE TABLE IF NOT EXISTS `canvas_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `canvas_project_id` int(11) NOT NULL,
  `data_inicio` varchar(255) NOT NULL,
  `data_fim` varchar(255) NOT NULL,
  `canvas_box_id` int(11) NOT NULL,
  `efeito` varchar(255) NOT NULL,
  `causa` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `postition` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `canvas_project_id` (`canvas_project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `canvas_project`
--
ALTER TABLE `canvas_project`
  ADD CONSTRAINT `fk_project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Limitadores para a tabela `canvas_ticket`
--
ALTER TABLE `canvas_ticket`
  ADD CONSTRAINT `fk_canvas_project_id` FOREIGN KEY (`canvas_project_id`) REFERENCES `canvas_project` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
