-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.6.18-MariaDB-ubu2004 - mariadb.org binary distribution
-- OS do Servidor:               debian-linux-gnu
-- HeidiSQL Versão:              12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela crm_imobiliario.imoveis
CREATE TABLE IF NOT EXISTS `imoveis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `quartos` int(11) NOT NULL,
  `preco` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela crm_imobiliario.imoveis: ~0 rows (aproximadamente)
INSERT INTO `imoveis` (`id`, `tipo`, `bairro`, `quartos`, `preco`) VALUES
	(4, 'Casa', 'Centro', 2, 2.00),
	(9, 'Casa', 'Centro', 4, 1.00),
	(10, 'Casa', 'Zona Norte', 4, 1.00),
	(11, 'Casa', 'Jardins', 2, 1.00),
	(12, 'Casa', 'Jardins', 2, 1.00),
	(13, 'Casa', 'Jardins', 1, 1.00),
	(15, 'Casa', 'Jardins', 4, 1.00);

-- Copiando estrutura para tabela crm_imobiliario.interesses
CREATE TABLE IF NOT EXISTS `interesses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `tipo_desejado` varchar(50) NOT NULL,
  `preco_min` decimal(12,2) DEFAULT NULL,
  `preco_max` decimal(12,2) DEFAULT NULL,
  `quartos_min` int(11) DEFAULT NULL,
  `bairros` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela crm_imobiliario.interesses: ~0 rows (aproximadamente)
INSERT INTO `interesses` (`id`, `nome`, `telefone`, `tipo_desejado`, `preco_min`, `preco_max`, `quartos_min`, `bairros`) VALUES
	(1, 'Geraldo', '9999-2315', 'Casa', 1.00, 3.00, 4, 'Centro'),
	(2, 'Geraldo', '9999-2315', 'Casa', 1.00, 3.00, 4, 'Centro'),
	(3, 'Geraldo', '9999-2315', 'Casa', 1.00, 2.00, 4, 'Centro'),
	(4, 'Geraldo', '9999-2315', 'Casa', 1.00, 2.00, 2, 'Jardins'),
	(5, 'Geraldo', '9999-2315', 'Casa', 1.00, 1.00, 4, 'Centro');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
