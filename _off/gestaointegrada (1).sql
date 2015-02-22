-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 20-Fev-2015 às 15:55
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
-- Estrutura da tabela `canvas_box`
--

CREATE TABLE IF NOT EXISTS `canvas_box` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `canvas_box`
--

INSERT INTO `canvas_box` (`id`, `name`) VALUES
(1, 'justificativas'),
(2, 'objectivesmart'),
(3, 'beneficios'),
(4, 'produto'),
(5, 'requisitos'),
(6, 'stakeholders'),
(7, 'premissas'),
(8, 'equipe'),
(9, 'grupoentregas'),
(10, 'restricoes'),
(11, 'riscos'),
(12, 'linhadotempo'),
(13, 'custos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `canvas_project`
--

CREATE TABLE IF NOT EXISTS `canvas_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gp` varchar(255) DEFAULT NULL,
  `pitch` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `canvas_project`
--

INSERT INTO `canvas_project` (`id`, `project_id`, `name`, `gp`, `pitch`) VALUES
(8, 7, 'Projeto Eu Magro', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `canvas_ticket`
--

CREATE TABLE IF NOT EXISTS `canvas_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `canvas_project_id` int(11) NOT NULL,
  `data_inicio` varchar(255) DEFAULT NULL,
  `data_fim` varchar(255) DEFAULT NULL,
  `canvas_box_id` int(11) NOT NULL,
  `efeito` varchar(255) DEFAULT NULL,
  `causa` varchar(255) DEFAULT NULL,
  `text` varchar(255) NOT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `canvas_project_id` (`canvas_project_id`),
  KEY `canvas_box_id` (`canvas_box_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `canvas_ticket`
--

INSERT INTO `canvas_ticket` (`id`, `canvas_project_id`, `data_inicio`, `data_fim`, `canvas_box_id`, `efeito`, `causa`, `text`, `position`) VALUES
(1, 8, NULL, NULL, 1, NULL, NULL, 'Testando este post-it em Justificativas', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `projects`
--

INSERT INTO `projects` (`id`, `name`, `parent_id`) VALUES
(3, 'Recursos Humanos', NULL),
(4, 'Almoxarifado', NULL),
(5, 'WAMPS 2012', NULL),
(6, 'Artigo Wamps', NULL),
(7, 'TESTE UFRJ', NULL),
(9, 'TCC IFF', NULL);

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
  ADD CONSTRAINT `fk_canvas_box_id` FOREIGN KEY (`canvas_box_id`) REFERENCES `canvas_box` (`id`),
  ADD CONSTRAINT `fk_canvas_project_id` FOREIGN KEY (`canvas_project_id`) REFERENCES `canvas_project` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
