CREATE DATABASE  IF NOT EXISTS `cnhind` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cnhind`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: cnhind
-- ------------------------------------------------------
-- Server version	5.6.11

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `assunto`
--

DROP TABLE IF EXISTS `assunto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assunto` (
  `id_assunto` int(11) NOT NULL AUTO_INCREMENT,
  `dsc_assunto` varchar(200) NOT NULL,
  `dsc_conceito` text,
  `dsc_file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_assunto`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assunto`
--

LOCK TABLES `assunto` WRITE;
/*!40000 ALTER TABLE `assunto` DISABLE KEYS */;
INSERT INTO `assunto` VALUES (88,'Horário Flexível','%3Cp%3EA%20rotina%20das%20grandes%20cidades%20e%20a%20busca%20por%20qualidade%20de%20vida%0At%C3%AAm%20feito%20empresas%20dos%20mais%20variados%20setores%20desenvolverem%0Anovas%20pol%C3%ADticas%20para%20seus%20empregados.%0AA%20jornada%20flex%C3%ADvel%20ou%20jornada%20m%C3%B3vel%20%C3%A9%20resultado%20da%20flexibilidade%0Apor%20meio%20da%20parceria%20entre%20empregador%20e%20empregado%2C%20a%20qual%0Apermite%20que%20o%20empregado%20cumpra%20sua%20jornada%20contratual%0Adentro%20de%20um%20hor%C3%A1rio%20previamente%20estabelecido%2C%20ou%20seja%2C%0Aconsiderando%20um%20limite%20inicial%20e%20final%20de%20hor%C3%A1rio%20de%20trabalho.%0AA%20legisla%C3%A7%C3%A3o%20trabalhista%20n%C3%A3o%20disp%C3%B5e%20de%20nenhum%20dispositivo%0Aque%20discipline%20a%20jornada%20de%20trabalho%20flex%C3%ADvel.%3C%2Fp%3E','acordos-flexiveis.pdf'),(89,'Lay-off','Durante%20o%20regime%20de%20layoff%2C%20bem%20como%20nos%2030%20ou%2060%20dias%20seguintes%20ao%20termo%20da%0Aaplica%C3%A7%C3%A3o%20do%20regime%20de%20layoff%20(suspens%C3%A3o%20dos%20contratos%20ou%20redu%C3%A7%C3%A3o%20do%20per%C3%ADodo%20normal%20de%20trabalho)%2C%0Aconsoante%20a%20medida%20n%C3%A3o%20exceda%20ou%20seja%20superior%20a%206%20meses%2C%20o%20empregador%20n%C3%A3o%20pode%20fazer%20cessar%20o%0Acontrato%20de%20trabalho%20de%20trabalhador%20abrangido%20pelo%20regime%20de%20layoff%2C%20exceto%20se%20se%20tratar%20de%20cessa%C3%A7%C3%A3o%0Ada%20comiss%C3%A3o%20de%20servi%C3%A7o%2C%20cessa%C3%A7%C3%A3o%20de%20contrato%20de%20trabalho%20a%20termo%20ou%20despedimento%20por%20facto%0Aimput%C3%A1vel%20ao%20trabalhador.%20','layoff.pdf'),(90,'Conceito teste','este%20e%20todos%20outros%20conceitos%20nesta%20p%C3%A1gina%20s%C3%A3o%20apenas%20testes%20para%20o%20sistema.%20Favor%20desconsiderar%20qualquer%20conteudo%20encontrado.%3Cbr%3E',''),(91,'Teste 2','%3Cspan%20style%3D%22font-weight%3A%20bold%3B%22%3Eeste%20%C3%A9%20um%20teste%20para%20verificar%20o%20comportamento%20do%20Javascript%20da%20p%C3%A1gina%3Cbr%3E%3C%2Fspan%3Eser%C3%A1%20exclu%C3%ADdo%20assim%20que%20os%20testes%20forem%20validados%20pelo%20solicitante.%3Cbr%3E','');
/*!40000 ALTER TABLE `assunto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historico_ocorrencia`
--

DROP TABLE IF EXISTS `historico_ocorrencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historico_ocorrencia` (
  `id_historico_ocorrencia` int(11) NOT NULL AUTO_INCREMENT,
  `dsc_field` varchar(45) DEFAULT NULL,
  `dsc_field_before` varchar(1000) DEFAULT NULL,
  `dsc_field_after` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id_historico_ocorrencia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historico_ocorrencia`
--

LOCK TABLES `historico_ocorrencia` WRITE;
/*!40000 ALTER TABLE `historico_ocorrencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `historico_ocorrencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `dsc_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (2,'Usuários'),(3,'Acordos'),(4,'Planta'),(5,'Período'),(6,'Interpretações'),(7,'Assuntos');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_ac_as`
--

DROP TABLE IF EXISTS `oc_ac_as`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_ac_as` (
  `id_oc_ac_as` int(11) NOT NULL AUTO_INCREMENT,
  `id_ocorrencia` int(11) NOT NULL,
  `id_tratado` int(11) NOT NULL,
  `dsc_file` varchar(100) DEFAULT NULL,
  `dsc_interpretacao` text,
  PRIMARY KEY (`id_oc_ac_as`,`id_ocorrencia`,`id_tratado`),
  KEY `fk_oc_ac_as_ocorrencia1_idx` (`id_ocorrencia`),
  KEY `fk_oc_ac_as_tratado1_idx` (`id_tratado`),
  CONSTRAINT `fk_oc_ac_as_ocorrencia1` FOREIGN KEY (`id_ocorrencia`) REFERENCES `ocorrencia` (`id_ocorrencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_oc_ac_as_tratado1` FOREIGN KEY (`id_tratado`) REFERENCES `tratado` (`id_tratado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_ac_as`
--

LOCK TABLES `oc_ac_as` WRITE;
/*!40000 ALTER TABLE `oc_ac_as` DISABLE KEYS */;
INSERT INTO `oc_ac_as` VALUES (99,63,2,'layoff3834.pdf','sdfsdfs\n\noutros testes'),(100,63,3,'layoff37111.pdf','testando cadastro com mais de um assunto'),(101,63,7,'layoff37112.pdf','O PPR em Curitiba não é aplicável.\nVeja mais informações no anexo disponível.'),(117,61,2,'layoff38152.pdf','teste falando sobre férias'),(118,61,3,'layoff381512.pdf','este outro falando sobre convenio médico\n\ne outras coisas'),(119,61,4,'layoff38222.pdf','odonto\n\nsas');
/*!40000 ALTER TABLE `oc_ac_as` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocorrencia`
--

DROP TABLE IF EXISTS `ocorrencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ocorrencia` (
  `id_ocorrencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_assunto` int(11) NOT NULL,
  `id_planta` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `dsc_resumo` varchar(1000) DEFAULT NULL,
  `dsc_file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_ocorrencia`,`id_assunto`,`id_planta`,`id_periodo`),
  KEY `fk_ocorrencia_assunto1_idx` (`id_assunto`),
  KEY `fk_ocorrencia_planta1_idx` (`id_planta`),
  KEY `fk_ocorrencia_periodo1_idx` (`id_periodo`),
  CONSTRAINT `fk_ocorrencia_assunto1` FOREIGN KEY (`id_assunto`) REFERENCES `assunto` (`id_assunto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ocorrencia_periodo1` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ocorrencia_planta1` FOREIGN KEY (`id_planta`) REFERENCES `planta` (`id_planta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocorrencia`
--

LOCK TABLES `ocorrencia` WRITE;
/*!40000 ALTER TABLE `ocorrencia` DISABLE KEYS */;
INSERT INTO `ocorrencia` VALUES (61,88,1,1,NULL,'layoff381521.pdf  '),(63,88,2,1,NULL,'layoff3822.pdf ');
/*!40000 ALTER TABLE `ocorrencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodo`
--

DROP TABLE IF EXISTS `periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodo` (
  `id_periodo` int(11) NOT NULL AUTO_INCREMENT,
  `dsc_periodo` varchar(45) NOT NULL,
  PRIMARY KEY (`id_periodo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo`
--

LOCK TABLES `periodo` WRITE;
/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
INSERT INTO `periodo` VALUES (1,'2015'),(2,'2016');
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planta`
--

DROP TABLE IF EXISTS `planta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planta` (
  `id_planta` int(11) NOT NULL AUTO_INCREMENT,
  `dsc_planta` varchar(45) NOT NULL,
  PRIMARY KEY (`id_planta`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planta`
--

LOCK TABLES `planta` WRITE;
/*!40000 ALTER TABLE `planta` DISABLE KEYS */;
INSERT INTO `planta` VALUES (1,'Sorocaba'),(2,'Curitiba'),(3,'Piracicaba'),(4,'Contagem'),(5,'Sete Lagoas'),(6,'Sorocaba DPR');
/*!40000 ALTER TABLE `planta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id_transactions` int(11) NOT NULL AUTO_INCREMENT,
  `dsc_name` varchar(100) DEFAULT NULL,
  `controller` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_transactions`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (2,'Admin. Usuários','usuario/retrieve'),(4,'Alterar Senha','usuario/trocar_senha'),(5,'Novo Usuário','usuario/create'),(6,'Novo Acordo','assunto/create'),(7,'Admin. Acordos','assunto/retrieve'),(8,'Nova Planta','planta/create'),(9,'Admin. Plantas','planta/retrieve'),(10,'Novo Período','periodo/create'),(11,'Admin. Períodos','periodo/retrieve'),(12,'Nova Interpretação','ocorrencia/create'),(13,'Admin. Interpretações','ocorrencia/retrieve'),(14,'Acordos','assunto/conceito'),(15,'Novo Assunto','tratado/create'),(16,'Admin. Assuntos','tratado/retrieve');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tratado`
--

DROP TABLE IF EXISTS `tratado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tratado` (
  `id_tratado` int(11) NOT NULL AUTO_INCREMENT,
  `dsc_tratado` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tratado`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tratado`
--

LOCK TABLES `tratado` WRITE;
/*!40000 ALTER TABLE `tratado` DISABLE KEYS */;
INSERT INTO `tratado` VALUES (1,'13º (Décimo Terceiro)'),(2,'Férias'),(3,'Convênio Médico'),(4,'Convênio Odontológico'),(5,'Bolsa Idiomas'),(7,'PPR');
/*!40000 ALTER TABLE `tratado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_menu`
--

DROP TABLE IF EXISTS `user_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_menu` (
  `id_user_roles` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_transactions` int(11) NOT NULL,
  PRIMARY KEY (`id_user_roles`,`id_menu`,`id_transactions`),
  KEY `fk_user_menu_transactions1_idx` (`id_transactions`),
  KEY `fk_user_menu_user_roles1_idx` (`id_user_roles`),
  KEY `fk_user_menu_menu1_idx` (`id_menu`),
  CONSTRAINT `fk_user_menu_menu1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_menu_transactions1` FOREIGN KEY (`id_transactions`) REFERENCES `transactions` (`id_transactions`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_menu_user_roles1` FOREIGN KEY (`id_user_roles`) REFERENCES `user_roles` (`id_user_roles`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_menu`
--

LOCK TABLES `user_menu` WRITE;
/*!40000 ALTER TABLE `user_menu` DISABLE KEYS */;
INSERT INTO `user_menu` VALUES (1,2,2),(2,2,2),(1,2,4),(2,2,4),(3,2,4),(1,2,5),(1,3,6),(1,3,7),(1,4,8),(1,4,9),(1,5,10),(1,5,11),(1,6,12),(1,6,13),(1,3,14),(1,7,15),(1,7,16);
/*!40000 ALTER TABLE `user_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `id_user_roles` int(11) NOT NULL AUTO_INCREMENT,
  `dsc_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_user_roles`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1,'Administrador'),(2,'Controlador'),(3,'Operador');
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(45) NOT NULL,
  `dsc_name` varchar(100) DEFAULT NULL,
  `dsc_matricula` varchar(45) DEFAULT NULL,
  `id_user_roles` int(11) NOT NULL,
  `ativo` varchar(1) DEFAULT NULL,
  `dt_added` datetime DEFAULT NULL,
  `dt_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`id_user_roles`),
  KEY `fk_users_user_roles_idx` (`id_user_roles`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'0','0','0','0',0,'0','0000-00-00 00:00:00','0000-00-00 00:00:00'),(36,'BFONSECA','202cb962ac59075b964b07152d234b70','BRUCE FONSECA','123',1,'A','0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,'0','0','0','0',0,'0','0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,'123','202cb962ac59075b964b07152d234b70','NOME','MATRICULA 27',1,'A','0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,'user id 28','caf1a3dfb505ffed0d024130f58c5cfa','NOME 28888','MATRICULA 28',1,'A','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-11  0:49:02
