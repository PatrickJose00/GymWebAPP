-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ginasio
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.21-MariaDB

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
-- Table structure for table `alimento`
--

DROP TABLE IF EXISTS `alimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alimento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  `Quantidade` int(11) NOT NULL,
  `Proteinas` decimal(10,0) NOT NULL,
  `Lipidos` decimal(10,0) NOT NULL,
  `CarboHidratos` decimal(10,0) NOT NULL,
  `Calorias` int(11) NOT NULL,
  `CategoriaAlimentos_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_AlimentosPredefinidos_CategoriaAlimentos1_idx` (`CategoriaAlimentos_id`),
  CONSTRAINT `fk_AlimentosPredefinidos_CategoriaAlimentos1` FOREIGN KEY (`CategoriaAlimentos_id`) REFERENCES `categoriaalimento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alimento`
--

LOCK TABLES `alimento` WRITE;
/*!40000 ALTER TABLE `alimento` DISABLE KEYS */;
INSERT INTO `alimento` VALUES (1,'Arroz Integral',100,8,2,78,359,9),(2,'Arroz Normal',100,7,2,79,359,9),(3,'Macarrao',100,9,17,78,371,5),(4,'Bolachas',100,6,12,75,443,2),(5,'Cerais Milho',100,7,1,84,382,10),(6,'Pao Trigo',100,3,3,59,300,8),(7,'Alface',100,1,0,2,11,4),(8,'Batata',100,1,0,24,101,4),(9,'Broculos',100,4,0,4,25,4),(10,'Couve Flor',100,2,0,5,23,4),(11,'Espinafre',100,2,0,5,16,4),(12,'Tomate',100,1,0,3,14,4),(13,'Banana',100,1,0,34,128,3),(14,'Laranja',100,1,0,11,45,3),(15,'Maça',100,0,0,15,56,3),(16,'Melancia',100,1,0,8,33,3),(17,'Moirangos',100,1,0,7,30,3),(18,'Atum',100,26,1,0,118,11),(19,'Bacalhau',100,29,1,0,136,11),(20,'Pescada',100,16,5,0,111,11),(21,'Sardinha',100,21,3,0,114,11),(22,'Carne Vitela',100,27,11,0,212,1),(23,'Asa de Frango',100,18,15,0,213,1),(24,'Cocha de Frango',100,17,10,0,161,1),(25,'Peito De Frango',100,21,7,0,148,1),(26,'Picanha',100,21,5,0,134,1),(27,'Iogurte Natural',100,4,3,2,51,12),(28,'Iogurte Sabores',100,3,2,10,70,12),(29,'Leite',100,25,27,39,479,12),(30,'Ovos Galinha',100,13,9,2,143,7),(31,'Café sem Acucar',100,15,12,66,419,6),(32,'Ervilha',100,5,0,14,75,4);
/*!40000 ALTER TABLE `alimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alimento_has_alimeto_plano_refeicao`
--

DROP TABLE IF EXISTS `alimento_has_alimeto_plano_refeicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alimento_has_alimeto_plano_refeicao` (
  `Alimento_id` int(11) NOT NULL,
  `Alimeto_Plano_Refeicao_id` int(11) NOT NULL,
  `Peso` int(11) NOT NULL,
  PRIMARY KEY (`Alimento_id`,`Alimeto_Plano_Refeicao_id`),
  KEY `fk_Alimento_has_Alimeto_Plano_Refeicao_Alimeto_Plano_Refeic_idx` (`Alimeto_Plano_Refeicao_id`),
  KEY `fk_Alimento_has_Alimeto_Plano_Refeicao_Alimento1_idx` (`Alimento_id`),
  CONSTRAINT `fk_Alimento_has_Alimeto_Plano_Refeicao_Alimento1` FOREIGN KEY (`Alimento_id`) REFERENCES `alimento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Alimento_has_Alimeto_Plano_Refeicao_Alimeto_Plano_Refeicao1` FOREIGN KEY (`Alimeto_Plano_Refeicao_id`) REFERENCES `alimeto_plano_refeicao` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alimento_has_alimeto_plano_refeicao`
--

LOCK TABLES `alimento_has_alimeto_plano_refeicao` WRITE;
/*!40000 ALTER TABLE `alimento_has_alimeto_plano_refeicao` DISABLE KEYS */;
INSERT INTO `alimento_has_alimeto_plano_refeicao` VALUES (4,70,40),(5,73,250),(13,71,120),(17,71,30),(23,74,10),(25,72,150);
/*!40000 ALTER TABLE `alimento_has_alimeto_plano_refeicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alimeto_plano_refeicao`
--

DROP TABLE IF EXISTS `alimeto_plano_refeicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alimeto_plano_refeicao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `PlanosdeNutricao_id` int(11) NOT NULL,
  `Dia` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Alimetos_Plano_Refeicao_PlanosdeNutricao1_idx` (`PlanosdeNutricao_id`),
  CONSTRAINT `fk_Alimetos_Plano_Refeicao_PlanosdeNutricao1` FOREIGN KEY (`PlanosdeNutricao_id`) REFERENCES `planodenutricao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alimeto_plano_refeicao`
--

LOCK TABLES `alimeto_plano_refeicao` WRITE;
/*!40000 ALTER TABLE `alimeto_plano_refeicao` DISABLE KEYS */;
INSERT INTO `alimeto_plano_refeicao` VALUES (70,4,1),(71,4,1),(72,4,1),(73,4,2),(74,2,1);
/*!40000 ALTER TABLE `alimeto_plano_refeicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alimeto_plano_refeicao_has_refeicao`
--

DROP TABLE IF EXISTS `alimeto_plano_refeicao_has_refeicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alimeto_plano_refeicao_has_refeicao` (
  `Alimeto_Plano_Refeicao_id` int(11) NOT NULL,
  `Refeicao_id` int(11) NOT NULL,
  PRIMARY KEY (`Alimeto_Plano_Refeicao_id`,`Refeicao_id`),
  KEY `fk_Alimeto_Plano_Refeicao_has_Refeicao_Refeicao1_idx` (`Refeicao_id`),
  KEY `fk_Alimeto_Plano_Refeicao_has_Refeicao_Alimeto_Plano_Refeic_idx` (`Alimeto_Plano_Refeicao_id`),
  CONSTRAINT `fk_Alimeto_Plano_Refeicao_has_Refeicao_Alimeto_Plano_Refeicao1` FOREIGN KEY (`Alimeto_Plano_Refeicao_id`) REFERENCES `alimeto_plano_refeicao` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_Alimeto_Plano_Refeicao_has_Refeicao_Refeicao1` FOREIGN KEY (`Refeicao_id`) REFERENCES `refeicao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alimeto_plano_refeicao_has_refeicao`
--

LOCK TABLES `alimeto_plano_refeicao_has_refeicao` WRITE;
/*!40000 ALTER TABLE `alimeto_plano_refeicao_has_refeicao` DISABLE KEYS */;
INSERT INTO `alimeto_plano_refeicao_has_refeicao` VALUES (70,1),(71,1),(72,2),(73,1),(74,1);
/*!40000 ALTER TABLE `alimeto_plano_refeicao_has_refeicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aula`
--

DROP TABLE IF EXISTS `aula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aula` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  `Descricao` varchar(500) NOT NULL,
  `ImageFile` varchar(100) NOT NULL,
  `Preco` decimal(4,2) NOT NULL,
  `Professor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Aula_Professor1_idx` (`Professor_id`),
  CONSTRAINT `fk_Aula_Professor1` FOREIGN KEY (`Professor_id`) REFERENCES `professor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aula`
--

LOCK TABLES `aula` WRITE;
/*!40000 ALTER TABLE `aula` DISABLE KEYS */;
INSERT INTO `aula` VALUES (1,'Kickbox','Esta aula está no TOP de queima-calorias! A aula é dividida em 3 fases: aquecimento, treino ou fase principal e retorno à calma/alongamento.','kickbox_1494278376.jpg',35.00,6),(2,'Indoor Cycling','Ao trabalhar cardio, agilidade e força, o Spartans integra diferentes componentes físicos para garantir um treino completo que é baseado nos 4 pilares do movimento humano.','indoor-cycling.jpg',20.00,1),(3,'Body Combat','Aula intensa de aeróbica de alto impacto. Muito símples de seguir e altamente enérgica. Permite o treino de várias qualidades físicas como força, coordenação, cardiovascular, entre outras.','bodycombat.jpg',25.00,2),(4,'Aerobica','Aula intensa de aeróbica de alto impacto. Muito símples de seguir e altamente enérgica. Permite o treino de várias qualidades físicas como força, coordenação, cardiovascular, entre outras.','aerobica.jpg',25.00,2),(8,'Dança','Dança sempre a dançar','danca.png',20.00,1);
/*!40000 ALTER TABLE `aula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoriaalimento`
--

DROP TABLE IF EXISTS `categoriaalimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoriaalimento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoriaalimento`
--

LOCK TABLES `categoriaalimento` WRITE;
/*!40000 ALTER TABLE `categoriaalimento` DISABLE KEYS */;
INSERT INTO `categoriaalimento` VALUES (1,'Carnes'),(2,'Biscoitos'),(3,'Fruta'),(4,'Vegetais'),(5,'Massas'),(6,'Nozes e Sementes e Graos'),(7,'Ovos'),(8,'Paes'),(9,'Arroz'),(10,'Cereais'),(11,'Peixes'),(12,'Laticinios');
/*!40000 ALTER TABLE `categoriaalimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoriaexercicio`
--

DROP TABLE IF EXISTS `categoriaexercicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoriaexercicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoriaexercicio`
--

LOCK TABLES `categoriaexercicio` WRITE;
/*!40000 ALTER TABLE `categoriaexercicio` DISABLE KEYS */;
INSERT INTO `categoriaexercicio` VALUES (1,'Peitoral'),(2,'Dorsais'),(3,'Ombros'),(4,'Bicep'),(5,'Trícep'),(6,'Antebraços'),(7,'Abdominais'),(8,'Lombares'),(9,'Quadríceps'),(10,'Glúteos'),(11,'Isoquiotibiais'),(12,'Adutores'),(13,'Abdutores'),(14,'Panturrilhas');
/*!40000 ALTER TABLE `categoriaexercicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoriaproduto`
--

DROP TABLE IF EXISTS `categoriaproduto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoriaproduto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoriaproduto`
--

LOCK TABLES `categoriaproduto` WRITE;
/*!40000 ALTER TABLE `categoriaproduto` DISABLE KEYS */;
INSERT INTO `categoriaproduto` VALUES (1,'Proteína'),(2,'Ganho de Massa / Gainers'),(3,'Creatina'),(4,'Aminoácidos'),(5,'Pré-Treino');
/*!40000 ALTER TABLE `categoriaproduto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  `BI` int(11) NOT NULL,
  `Contribuinte` int(11) NOT NULL,
  `Telefone` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Morada_id` int(11) NOT NULL,
  `DataNascimento` int(11) NOT NULL,
  `Genero` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Cliente_User1_idx` (`User_id`),
  KEY `fk_Cliente_Morada1_idx` (`Morada_id`),
  CONSTRAINT `fk_Cliente_Morada1` FOREIGN KEY (`Morada_id`) REFERENCES `morada` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cliente_User1` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (35,'Rui Santos Costa',121232345,323234345,2147483647,43,41,1347314400,0),(36,'Joana Martins dos Santos',232345456,121234345,932343234,44,42,628815600,1),(37,'José Santos',121232121,123434545,278676543,45,43,318812400,0),(38,'Artur Santos',126767890,876543456,278678678,46,44,1500415200,0);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exercicio`
--

DROP TABLE IF EXISTS `exercicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exercicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  `Descricao` varchar(45) NOT NULL,
  `CategoriaExercicio_id` int(11) NOT NULL,
  `Foto` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Exercicios_CategoriaExercicio1_idx` (`CategoriaExercicio_id`),
  CONSTRAINT `fk_Exercicios_CategoriaExercicio1` FOREIGN KEY (`CategoriaExercicio_id`) REFERENCES `categoriaexercicio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exercicio`
--

LOCK TABLES `exercicio` WRITE;
/*!40000 ALTER TABLE `exercicio` DISABLE KEYS */;
INSERT INTO `exercicio` VALUES (1,'SUPINO COM BARRA','O supino com barra em banco plano é o exercíc',1,'supino_barra.jpg'),(2,'SUPINO INCLINADO COM BARRA','Esta variação do supino plano coloca uma maio',1,'supino_inclinado_barra.jpg'),(3,'SUPINO DECLINADO COM BARRA','O supino declinado é a variação do supino que',1,'supino_declinado_barra.jpg'),(4,'SUPINO EM MÁQUINA','O supino em máquina é indicado especialmente ',1,'supino_em_maquina.jpg'),(5,'SUPINO COM HALTERES','Esta variação do supino, é em quase tudo seme',1,'supino_halteres.jpg'),(6,'SUPINO INCLINADO COM HALTERES','Esta variação do supino inclinado, é em quase',1,'supino_inclinado_halteres.jpg'),(7,'SUPINO DECLINADO COM HALTERES','Esta variação do supino inclinado, é em quase',1,'supino_declinado_halteres.jpg'),(8,'CRUCIFIXO / ABERTURAS COM HALTERES','Existem dois tipos básicos de exercícios para',1,'crucifixo_aberturas_com_halteres.jpg'),(9,'CRUCIFIXO / ABERTURAS INCLINADO COM HALTERES','Esta variação do movimento aberturas, trabalh',1,'crucifixo_aberturas_inclinado_halteres.jpg'),(10,'CRUCIFIXO / ABERTURAS DECLINADO COM HALTERES','Esta variação do movimento aberturas, trabalh',1,'crucifixo_aberturas_declinado_halteres.jpg'),(11,'CRUCIFIXO / ABERTURAS DEITADO EM POLIA BAIXA','Esta é uma variação interessante do movimento',1,'crucifixo_deitado_polia_baixa.jpg'),(12,'CRUCIFIXO / ABERTURAS EM PÉ EM POLIA BAIXA','Esta é uma outra variação interessante do mov',1,'crucifixo_aberturas_em_pe_polia_baixa.jpg'),(13,'CRUCIFIXO / ABERTURAS EM MÁQUINA','As aberturas em máquina são uma melhor opção ',1,'crucifixo_aberturas_maquina.jpg'),(14,'PESO MORTO / LEVANTAMENTO TERRA',' Nesta variação do peso morto, a mais conheci',2,'peso_morto_levantamento_terra.jpg'),(15,'PUXADA DE DORSAIS EM POLIA ALTA','A puxada de dorsais em polia alta (pela frent',2,'puxada_dorsais_polia_alta.jpg'),(16,'PUXADA DE DORSAIS EM POLIA ALTA EM SUPINAÇÃO',' Esta variação da puxada de dorsais em polia ',2,'puxada_dorsais_polia_alta_supinação.jpg'),(17,'REMADA COM BARRA','Este é o exercício de remada com barra mais c',2,'remada_com_barra.jpg'),(18,'REMADA COM BARRA EM SUPINAÇÃO','Nesta variação da remada com barra utiliza-se',2,'Remada-com-barra-em-supinação.jpg'),(19,'REMADA EM MÁQUINA “HAMMER”','Esta variação da remada proporciona duas gran',2,'remada_máquina_hammer.jpg'),(20,'REMADA EM POLIA BAIXA','Esta variação da remada proporciona duas gran',2,'remada_polia_baixa.jpg'),(21,'REMADA EM POLIA BAIXA A 1 MÃO','Esta variação da remada em polia baixa permit',2,'remo_horizontal_a_una_mano_con_mancuernas2.jpg'),(22,'REMADA COM HALTER','Esta é a variação de remada ideal para treina',2,'remada_com_halter.jpg'),(23,'REMADA EM BARRA T','Tal como acontece com a  remada em máquina ha',2,'remada_barra_T.jpg'),(24,'ENCOLHIMENTOS DE OMBROS COM HALTERES','Este exercício consiste em elevar os ombros e',2,'Encolhimentos-de-ombros-com-halteres.jpg'),(25,'ENCOLHIMENTOS DE OMBROS COM BARRA','A imagem é auto-explicativa, portanto iremos ',2,'encolhimento_barra.jpg'),(26,'ENCOLHIMENTOS COM BARRA ATRÁS','A única diferença desta variação em relação à',2,'encolhimentos_barra_atrás.jpg'),(27,'PRESS MILITAR COM BARRA','O movimento mais conhecido para trabalhar os ',3,'press_militar_barra.jpg'),(28,'PRESS MILITAR COM HALTERES','Este é muito provavelmente o melhor exercício',3,'press_militar_halteres1.jpg'),(29,'REMADA VERTICAL','Este é um excelente movimento composto para a',3,'remada_vertical.jpg'),(30,'ELEVAÇÕES FRONTAIS COM BARRA','Este exercício permite concentrar o trabalho ',3,'elevações_frontais_barra.jpg'),(31,'EXERCÍCIOS DE OMBROS','Este exercício permite concentrar o trabalho ',3,'elevacoes_frontais_pronação.jpg'),(32,'ELEVAÇÕES FRONTAIS COM HALTER / EM SEMI-PRONA','Esta variação das elevações frontais utiliza ',3,'elevacoes_frontais_semi-pronação.jpg'),(33,'ELEVAÇÃO LATERAL COM HALTERES','Este exercício permite concentrar o trabalho ',3,'elevaçôes_laterais_halteres.jpg'),(34,'ELEVAÇÃO LATERAL NA MÁQUINA',' Esta variação do exercício elevação lateral ',3,'Elevação-lateral-na-máquina.jpg'),(35,'ELEVAÇÃO LATERAL NA POLIA','Esta variação do exercício elevação lateral é',3,'Elevação-lateral-na-polia.jpg'),(36,'VOOS (ELEVAÇÕES POSTERIORES) COM HALTERES',' Este exercício permite concentrar o trabalho',3,'voos_halteres-403x315.jpg'),(37,'VOOS COM HALTERES / CABEÇA APOIADA',' Esta variação permite a realização do movime',3,'Voos_halteres_cabeça_apoiada-414x315.jpg'),(38,'VOOS EM MÁQUINA','Os voos em máquina têm diversas vantagens em ',3,'voos_máquina.jpg'),(39,'VOOS EM POLIA ALTA','Esta variação permite a manutenção do mesmo n',3,'voos_polia_alta.jpg'),(40,'CURL / ROSCA COM BARRA','O curl com barra é o movimento mais conhecido',4,'curl_barra_reta.jpg'),(41,'CURL / ROSCA COM HALTERES','O movimento mais conhecido e realizado a segu',4,'curl_halteres_sentado.jpg'),(42,'CURL DE CONCENTRAÇÃO (ROSCA CONCENTRADA)','Segundo análises EMG, este é o exercícios mai',4,'curl_concentracao.jpg'),(43,'CURL / ROSCA SCOOT COM BARRA','Popularizada por Larry Scoot, o primeiro Mr. ',4,'curl_scoot_barra.jpg'),(44,'CURL / ROSCA SCOOT COM HALTER','Esta variação do Curl Scoot permite que se co',4,'curl_scoot_halter.jpg'),(45,'CURL / ROSCA SCOOT EM MÁQUINA','Esta variação do Curl Scoot tem a vantagem de',4,'curl_scoot_máquina.jpg'),(46,'CURL / ROSCA EM MÁQUINA','O curl em máquina é ideal para principiantes ',4,'curl_máquina.jpg'),(47,'CURL / ROSCA EM POLIA BAIXA','O curl em polia baixa é uma variação interess',4,'curl_biceps_polia_baixa.jpg'),(48,'CURL / ROSCA BÍCEPS EM POLIA ALTA','Mais uma variação interessante, que permite t',4,'curl_bíceps_polia_alta.jpg'),(49,'FUNDOS EM BARRAS PARALELAS','Um dos melhores exercícios para trabalhar os ',5,'fundos_barras_paralelas.jpg'),(50,' FUNDOS EM MÁQUINA','Esta variação de fundos é ideal para principi',5,'fundos_máquina.jpg'),(51,'SUPINO PEGA JUNTA','Esta variação do supino permite um maior foco',5,'supino_pega_junta.jpg'),(52,'XTENSÕES DE TRÍCEPS DEITADO COM BARRA',' Este é o segundo exercícios (com equipamento',5,'extensao_de_triceps_deitado.jpg'),(53,'EXTENSÕES DE TRÍCEPS SENTADO COM BARRA','Esta variação do exercícios extensões de tríc',5,'extensão_triceps_sentado.jpg'),(54,'EXTENSÕES DE TRÍCEPS SENTADO COM HALTER','Mais uma variação, que se encontra a um nível',5,'extensão_triceps_sentado_halter.jpg'),(55,'PUXADA DE TRÍCEPS','Este é o exercício mais eficiente para os trí',5,'puxada_triceps.jpg'),(56,'PUXADA DE TRÍCEPS EM SUPINAÇÃO','Nesta variação usa-se um agarre em supinação ',5,'puxada_para_triceps_em_supinação.jpg'),(57,'PUXADA DE TRÍCEPS COM CORDA','Este é o melhor exercício para isolar a cabeç',5,'puxada_para_triceps_corda1.jpg'),(58,'KICKBACK','O seu programa de treino de tríceps não ficar',5,'Kickback.jpg'),(59,'KICKBACK EM POLIA','Esta variação do Kickback tem a vantagem de m',5,'kickback-em-polia.jpg'),(60,'CURL / ROSCA COM BARRA EM PRONAÇÃO','Esta variação do curl com barra é realizada d',6,'Curl_pronacao_barra.jpg'),(61,'CURL / ROSCA COM HALTER EM SEMI-PRONAÇÃO (MAR','Mais uma variação do curl com halteres, desta',6,'Rosca-martelo-com-halteres.jpg'),(62,'FLEXÃO DOS PUNHOS EM PRONAÇÃO','Este exercício é o ideal para quem pretende t',6,'Extensões_antebraços_barra.jpg'),(63,'FLEXÃO DOS PUNHOS EM SUPINAÇÃO','Este é o exercício mais utilizado para trabal',6,'Flexão_do_punho_em_supinação.jpg'),(64,'FLEXÃO DO QUADRIL SUSPENSO EM BARRA FIXA','Muito mais do que acontece com os exercícios ',7,'Flexao_do_quadril_suspenso_barra_fixa_abdominal.jpg'),(65,'FLEXÃO DO QUADRIL EM BANCO PLANO','Esta variante da flexão do quadril é mais ind',7,'flexão_quadril_banco_abdominal.jpg'),(66,'FLEXÃO DO QUADRIL EM BANCO INCLINADO','Mais uma variante do exercício flexão de quad',7,'flexão_quadril_banco_inclinado.jpg'),(67,'FLEXÃO DO QUADRIL EM BANCO INCLINADO COM HALT','Nesta variação do exercício, utiliza-se um ha',7,'flexão_quadril_banco_inclinado_peso.jpg'),(68,'ABDOMINAL COM FLEXÃO DO QUADRIL','Neste exercício, deverá mover o tronco e as p',7,'abdominal_com_flexão_quadril.jpg'),(69,'ABDOMINAL EM BANCO INCLINADO','Um exercício de abdominais clássico. Poderá e',7,'Abdominal_banco.jpg'),(70,'ABDOMINAL EM POLIA ALTA','Um dos melhores exercícios de abdominais em e',7,'abdominal_polia_alta.jpg'),(71,'ROTAÇÃO DO TRONCO COM BASTÃO','Este exercício trabalha sobretudo os músculos',7,'rotacao_tronco_bastao.jpg'),(72,'PRANCHA','A prancha (plank) é um excelente exercício is',7,'prancha_abdominal.jpg'),(73,'PRANCHA LATERAL','Este é um “parente” próximo do exercício pran',7,'prancha_lateral_abdominal.jpg'),(74,'ABDOMINAL EM RODA','Os abdominais em roda são muito provavelmente',7,'abdominal_roda_joelhos.jpg'),(75,'ABDOMINAL EM RODA (EM PÉ)','Esta é uma variação do abdominal em roda que ',7,'abdominal_roda_pé.jpg'),(76,'BOM DIA',' Este é um movimento bastante fácil de realiz',8,'Bom_dia.jpg'),(77,'HIPEREXTENSÕES','Este é um exercícios bastante fácil de realiz',8,'hiperextensões.jpg'),(78,'HIPEREXTENSÕES EM BANCO INCLINADO','Esta variação do exercício hiperextensões rea',8,'hiperextensões-em-banco-inclinado.jpg'),(79,'HIPEREXTENSÕES EM MÁQUINA','Esta é outra variação do exercício hiperexten',8,'hiperextensões-em-máquina.jpg'),(80,'FLUTTER KICKS','Segundo um estudo em que foram realizadas aná',8,'flutter-kicks.jpg'),(81,'SUPER-HOMEM','Mais um excelente movimento para trabalhar e ',8,'superman.jpg'),(82,'ELEVAÇÃO ALTERNADA DE SEGMENTOS','Este exercício encontra-se ao nível dos melho',8,'bird-dog.jpg'),(83,'AGACHAMENTO COM BARRA','O exercício número um para trabalhar as perna',9,'agachamento_com_barra.jpg'),(84,'AGACHAMENTO FRONTAL','O agachamento frontal é uma variação do agach',9,'agachamento_frontal.jpg'),(85,'AGACHAMENTO HACK EM MÁQUINA','O agachamento hack (encostado na máquina, joe',9,'agachamento_hack.jpg'),(86,'PRENSA DE PERNAS',' A prensa de pernas fica em terceiro lugar na',9,'Prensa_de_pernas.jpg'),(87,'AFUNDO','Um excelente exercício para aqueles que não c',9,'afundo.jpg'),(88,'AFUNDO COM BARRA','Nesta variação, a única diferença é que se us',9,'afundo2.jpg'),(89,'EXTENSÕES DE PERNAS','Este é um exercícios de isolamento para os qu',9,'extensao_de_pernas.jpg'),(90,'STEP-UP','Um excelente exercício composto para trabalha',10,'step-up.jpg'),(91,'EXTENSÃO DO QUADRIL / GLÚTEOS EM MÁQUINA','Este exercício de isolamento poderá ser útil ',10,'Extensão_do_quadril_glúteos_máquina.jpg'),(92,'EXTENSÃO DO QUADRIL / GLÚTEOS EM POLIA BAIXA','Esta variação do exercício extensão do quadri',10,'extensão_do_quadril_glúteos_polia_baixa.jpg'),(93,'EXTENSÃO DO QUADRIL / GLÚTEOS NO SOLO','Como poderá facilmente constatar, esta variaç',10,'extensao_do_quadril_glúteo_no_solo-420x292.jpg'),(94,'EXTENSÃO DO QUADRIL / GLÚTEOS COM PÉS APOIADO','Este exercício para além de trabalhar os glút',10,'extensao_do_quadril_glúteos_no_solo.jpg'),(95,'EXTENSÃO DO QUADRIL / GLÚTEOS COM PÉS APOIADO','Mais uma variação que não necessita de equipa',10,'extensão_do_quadril_glúteos_em_banco_glúteos-420x254.jpg'),(96,'PESO MORTO / LEVANTAMENTO TERRA A PERNAS RETA','Este exercício é uma variação do peso morto c',11,'peso_morto_pernas_retas.jpg'),(97,'BOM DIA','A imagem é auto-explicativa, este exercício é',11,'bom_dia.jpg'),(98,'BOM DIA A PERNAS RETAS','Nesta variação, as pernas permanecem retas (m',11,'bom_dia_2-232x315.jpg'),(99,' FLEXÃO DE PERNAS','Embora os músculos isquiotibiais não sejam mu',11,'flexao_da_perna_deitado.jpg'),(100,'FLEXÃO DE PERNAS EM PÉ','Nesta variação de flexão de perna, treina-se ',11,'flexao_de_perna_em_pe.jpg'),(101,'MÁQUINA ADUTORA','Infelizmente nenhum exercício composto trabal',12,'cadeira-adultora1.jpg'),(102,'ADUTORES EM POLIA BAIXA','Mais um bom exercício de isolamento para os a',12,'adutores_com_polia_baixa.jpg'),(103,'PESO MORTO SUMÔ / LEVANTAMENTO TERRA SUMÔ',' Esta é a variação de peso morto que mais rec',12,'levantamentoterrasumo1.jpg'),(104,'MÁQUINA ABDUTORA','Este exercício é ideal para aqueles que não r',13,'máquina_abdutora.jpg'),(105,'ABDUÇÃO EM POLIA BAIXA','Mais um bom exercício de isolamento para os m',13,'abdução_em_polia_baixa.jpg'),(106,'ABDUÇÃO NO CHÃO','Este exercício tem a grande vantagem de não n',13,'abdução_no_chão.jpg'),(107,'ELEVAÇÕES DE GÉMEOS / PANTURRILHAS EM PÉ','É imperativo não forçar o “fecho” da articula',14,'elevações_de_gémeos_panturrilhas_em_pé.jpg'),(108,'ELEVAÇÕES DE GÉMEOS / PANTURRILHAS TIPO BURRO','Segundos os resultados de um estudo em que fo',14,'elevações_de_gémeos_tipo_burro_donkey_calf_raises.jpg'),(109,'ELEVAÇÕES DE GÉMEOS / PANTURRILHAS EM MÁQUINA','Esta variação é a ideal para quem tem problem',14,'gémeos_panturrilha_em_máquina.jpg'),(110,'ELEVAÇÕES DE GÉMEOS / PANTURRILHAS SENTADO','Esta variação do exercício elevações de gémeo',14,'gémeos_panturrilha_sentado.jpg');
/*!40000 ALTER TABLE `exercicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exercicio_plano`
--

DROP TABLE IF EXISTS `exercicio_plano`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exercicio_plano` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Exercicios_id` int(11) NOT NULL,
  `Repeticoes` int(11) NOT NULL,
  `Carga` int(11) NOT NULL,
  `Pausa` int(11) NOT NULL,
  `Series` int(11) NOT NULL,
  `Dia` int(11) NOT NULL,
  `Plano_de_Treino_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Exercicios_Planos_Exercicios1_idx` (`Exercicios_id`),
  KEY `fk_Exercicio_Plano_Plano_de_Treino1_idx` (`Plano_de_Treino_id`),
  CONSTRAINT `fk_Exercicio_Plano_Plano_de_Treino1` FOREIGN KEY (`Plano_de_Treino_id`) REFERENCES `plano_de_treino` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Exercicios_Planos_Exercicios1` FOREIGN KEY (`Exercicios_id`) REFERENCES `exercicio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exercicio_plano`
--

LOCK TABLES `exercicio_plano` WRITE;
/*!40000 ALTER TABLE `exercicio_plano` DISABLE KEYS */;
INSERT INTO `exercicio_plano` VALUES (15,1,15,509,60,3,1,1),(16,4,15,80,70,4,1,1),(17,27,20,40,30,3,1,1),(18,64,20,10,10,3,2,1),(19,14,1,1,1,1,1,1);
/*!40000 ALTER TABLE `exercicio_plano` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galeriagym`
--

DROP TABLE IF EXISTS `galeriagym`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galeriagym` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(200) NOT NULL,
  `Imagem` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galeriagym`
--

LOCK TABLES `galeriagym` WRITE;
/*!40000 ALTER TABLE `galeriagym` DISABLE KEYS */;
INSERT INTO `galeriagym` VALUES (1,'Título Imagem 1','gym_inside_1.jpg'),(2,'Título Imagem 2','gym_inside_2.jpg'),(3,'Título Imagem 3','gym_inside_3.jpg'),(4,'Título Imagem 4','gym_inside_4.jpg'),(5,'Título Imagem 5','gym_inside_5.jpg'),(6,'Título Imagem 6','gym_inside_6.jpg'),(7,'Título Imagem 7','gym_inside_7.jpg'),(8,'Título Imagem 8','gym_inside_8.jpg');
/*!40000 ALTER TABLE `galeriagym` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galeriainicial`
--

DROP TABLE IF EXISTS `galeriainicial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galeriainicial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(200) NOT NULL,
  `Imagem` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galeriainicial`
--

LOCK TABLES `galeriainicial` WRITE;
/*!40000 ALTER TABLE `galeriainicial` DISABLE KEYS */;
INSERT INTO `galeriainicial` VALUES (1,'Interior Máquinas','gallery-top-1.jpg'),(2,'Exterior','gallery-top-2.jpg'),(3,'Piscina Interior','gallery-top-3.jpg'),(4,'Piscina Exterior','gallery-top-4.jpg');
/*!40000 ALTER TABLE `galeriainicial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscricao`
--

DROP TABLE IF EXISTS `inscricao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscricao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Aula_id` int(11) NOT NULL,
  `Registo_id` int(11) NOT NULL,
  `Preco` decimal(4,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Inscricao_Aulas1_idx` (`Aula_id`),
  KEY `fk_Inscricao_Registo1_idx` (`Registo_id`),
  CONSTRAINT `fk_Inscricao_Aulas1` FOREIGN KEY (`Aula_id`) REFERENCES `aula` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Inscricao_Registo1` FOREIGN KEY (`Registo_id`) REFERENCES `registo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscricao`
--

LOCK TABLES `inscricao` WRITE;
/*!40000 ALTER TABLE `inscricao` DISABLE KEYS */;
INSERT INTO `inscricao` VALUES (29,1,56,35.00),(30,2,56,20.00),(31,4,57,25.00),(32,1,59,35.00);
/*!40000 ALTER TABLE `inscricao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensalidade`
--

DROP TABLE IF EXISTS `mensalidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensalidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Pack_id` int(11) NOT NULL,
  `Preco` decimal(4,2) NOT NULL,
  `NumeroEntradas` int(11) NOT NULL,
  `Registo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Mensalidade_Pack1_idx` (`Pack_id`),
  KEY `fk_Mensalidade_Registo1_idx` (`Registo_id`),
  CONSTRAINT `fk_Mensalidade_Pack1` FOREIGN KEY (`Pack_id`) REFERENCES `pack` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Mensalidade_Registo1` FOREIGN KEY (`Registo_id`) REFERENCES `registo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensalidade`
--

LOCK TABLES `mensalidade` WRITE;
/*!40000 ALTER TABLE `mensalidade` DISABLE KEYS */;
INSERT INTO `mensalidade` VALUES (14,3,30.00,0,54),(15,2,25.00,3,55),(16,3,30.00,0,58);
/*!40000 ALTER TABLE `mensalidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `morada`
--

DROP TABLE IF EXISTS `morada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `morada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Endereco` varchar(300) NOT NULL,
  `Latitude` decimal(10,8) NOT NULL,
  `Longitude` decimal(11,8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `morada`
--

LOCK TABLES `morada` WRITE;
/*!40000 ALTER TABLE `morada` DISABLE KEYS */;
INSERT INTO `morada` VALUES (41,'R. de Agramonte 200, 4100 Porto, Portugal',41.15741610,-8.63194690),(42,'Rua da Boavista 453-457, 4050 Porto, Portugal',41.15617680,-8.61864860),(43,'N210, 4890, Portugal',41.38055900,-7.99443200),(44,'Rua Hospital 45, 4455 Santa Cruz do Bpo., Portugal',41.20929170,-8.67508540);
/*!40000 ALTER TABLE `morada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pack`
--

DROP TABLE IF EXISTS `pack`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `Descricao` varchar(200) NOT NULL,
  `Preco` decimal(4,2) NOT NULL,
  `NumeroEntradas` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pack`
--

LOCK TABLES `pack` WRITE;
/*!40000 ALTER TABLE `pack` DISABLE KEYS */;
INSERT INTO `pack` VALUES (1,'Pack Light','15 Cardio Classes, 10 Swimming Lesson, 10 Yoga Classes, 20 Aerobics',20.00,2),(2,'Pack Medium','22 Cardio Classes, 3 Swimming Lesson, 12 Yoga Classes, 2 Aerobics',25.00,3),(3,'Pack Free','5 Cardio Classes, 8 Swimming Lesson, 4 Yoga Classes, 3 Aerobics',30.00,0),(4,'Pack Ultra','50Cardio Classes,50Swimming Lesson, 50 Yoga Classes, 50 Aerobics',99.99,0);
/*!40000 ALTER TABLE `pack` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plano_de_treino`
--

DROP TABLE IF EXISTS `plano_de_treino`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plano_de_treino` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Nome_UNIQUE` (`Nome`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plano_de_treino`
--

LOCK TABLES `plano_de_treino` WRITE;
/*!40000 ALTER TABLE `plano_de_treino` DISABLE KEYS */;
INSERT INTO `plano_de_treino` VALUES (1,'Bulk'),(3,'Cut'),(4,'Dores'),(5,'Intense Cut'),(2,'Manutenção');
/*!40000 ALTER TABLE `plano_de_treino` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plano_treino_cliente`
--

DROP TABLE IF EXISTS `plano_treino_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plano_treino_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Clientes_id` int(11) NOT NULL,
  `Plano_de_Treino_id` int(11) NOT NULL,
  `Data` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Planos_Clientes_Clientes1_idx` (`Clientes_id`),
  KEY `fk_Plano_Treino_Cliente_Plano_de_Treino1_idx` (`Plano_de_Treino_id`),
  CONSTRAINT `fk_Plano_Treino_Cliente_Plano_de_Treino1` FOREIGN KEY (`Plano_de_Treino_id`) REFERENCES `plano_de_treino` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Planos_Clientes_Clientes1` FOREIGN KEY (`Clientes_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plano_treino_cliente`
--

LOCK TABLES `plano_treino_cliente` WRITE;
/*!40000 ALTER TABLE `plano_treino_cliente` DISABLE KEYS */;
INSERT INTO `plano_treino_cliente` VALUES (7,35,1,1499046324),(8,36,1,1499046817),(9,37,1,1499076704);
/*!40000 ALTER TABLE `plano_treino_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planodenutricao`
--

DROP TABLE IF EXISTS `planodenutricao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planodenutricao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planodenutricao`
--

LOCK TABLES `planodenutricao` WRITE;
/*!40000 ALTER TABLE `planodenutricao` DISABLE KEYS */;
INSERT INTO `planodenutricao` VALUES (2,'Comida Saudável'),(4,'Dieta Cut');
/*!40000 ALTER TABLE `planodenutricao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planonutricao`
--

DROP TABLE IF EXISTS `planonutricao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planonutricao` (
  `id_PlanoNutricao` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  `PlanoNutricaocol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_PlanoNutricao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planonutricao`
--

LOCK TABLES `planonutricao` WRITE;
/*!40000 ALTER TABLE `planonutricao` DISABLE KEYS */;
/*!40000 ALTER TABLE `planonutricao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planos_nutricao_cliente`
--

DROP TABLE IF EXISTS `planos_nutricao_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planos_nutricao_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Clientes_id` int(11) NOT NULL,
  `PlanosdeNutricao_id` int(11) NOT NULL,
  `Data` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Planos_Clientes_Clientes2_idx` (`Clientes_id`),
  KEY `fk_Planos_Clientes_PlanosdeNutricao1_idx` (`PlanosdeNutricao_id`),
  CONSTRAINT `fk_Planos_Clientes_Clientes2` FOREIGN KEY (`Clientes_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Planos_Clientes_PlanosdeNutricao1` FOREIGN KEY (`PlanosdeNutricao_id`) REFERENCES `planodenutricao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planos_nutricao_cliente`
--

LOCK TABLES `planos_nutricao_cliente` WRITE;
/*!40000 ALTER TABLE `planos_nutricao_cliente` DISABLE KEYS */;
INSERT INTO `planos_nutricao_cliente` VALUES (3,36,4,1499046801),(4,35,2,1499046812),(5,35,4,1499048305),(6,37,4,1499076709);
/*!40000 ALTER TABLE `planos_nutricao_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planosdenutricao`
--

DROP TABLE IF EXISTS `planosdenutricao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planosdenutricao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planosdenutricao`
--

LOCK TABLES `planosdenutricao` WRITE;
/*!40000 ALTER TABLE `planosdenutricao` DISABLE KEYS */;
/*!40000 ALTER TABLE `planosdenutricao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presenca`
--

DROP TABLE IF EXISTS `presenca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `presenca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Data_Hora` int(11) NOT NULL,
  `Mensalidade_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Presenca_Mensalidade1_idx` (`Mensalidade_id`),
  CONSTRAINT `fk_Presenca_Mensalidade1` FOREIGN KEY (`Mensalidade_id`) REFERENCES `mensalidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presenca`
--

LOCK TABLES `presenca` WRITE;
/*!40000 ALTER TABLE `presenca` DISABLE KEYS */;
INSERT INTO `presenca` VALUES (1,1499071159,15),(2,1499071232,15),(3,1499072739,15);
/*!40000 ALTER TABLE `presenca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  `Descricao` text NOT NULL,
  `Preco` double(6,2) NOT NULL,
  `Imagem` varchar(100) DEFAULT NULL,
  `SubCategoriaProduto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Produto_SubCategoriaProduto1_idx` (`SubCategoriaProduto_id`),
  CONSTRAINT `fk_Produto_SubCategoriaProduto1` FOREIGN KEY (`SubCategoriaProduto_id`) REFERENCES `subcategoriaproduto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` VALUES (13,'100% Whey Hydro Isolate SS 2000 g','A proteína whey mais pura, com um perfil de aminoácidos incomparável e fortificada com vitaminas essenciais, que contribuirá para o crescimento e manutenção da tua massa muscular.',49.99,'100__Whey_Hydro_Isolate_SS_2000_g_1495977704.jpg',2),(14,'100% Whey Prime 2.0 1250g','O melhor tornou-se ainda melhor! 100% Whey Prime 2.0 enriquecido com creatina, BCAA e glutamina para que consigas impulsionar os processos de construção de músculo do teu corpo!',17.99,'100__Whey_Prime_2.0_1250g_1496104887.jpg',1),(15,'Xtreme Whey Protein SS 900 g','Contribuindo para o crescimento e manutenção da massa muscular, o 100% Xtreme Whey Protein não só te ajudará a potenciar o teu aumento muscular, como também te permitirá desfrutar sempre que beberes este batido!',21.99,'Xtreme_Whey_Protein_SS_900_g_1496104965.jpg',1),(16,'100% Whey Protein Advanced 2000 g','Combinando ciência, inovação e qualidade, o novo 100% Whey Protein Advanced é uma referência na evolução das proteínas whey em pó e a escolha ideal para os atletas que apenas se contentam com o melhor.\r\n',39.99,'100__Whey_Protein_Advanced_2000_g_1496105073.jpg',1),(17,'100% Whey Premium Protein 900 g','Ideal para aqueles com um estilo de vida ativo, a proteína de alta qualidade 100% Whey da Prozis é um suplemento de whey de alto valor nutricional concebido para apoiar todos os objetivos de fitness.',17.99,'100__Whey_Premium_Protein_900_g_1496105222.jpg',1),(18,'IsoHydro Whey 1 kg','GoldNutrition® IsoHydro Whey is a delicious high-quality protein shake that combines the two best sources of whey protein on the market, ISOLAC® and OPTIPEP®, and high quality hydrolysed protein isolate, produced by CARBERY.\r\nISOLAC® is obtained through cross-flow microfiltration (CFM), while OPTIPEP® is obtained through the enzymatic hydrolysis of the whey protein isolate.',47.50,'IsoHydro_Whey_1_kg_1496178256.jpg',2),(19,'100% Whey Isolate 4,40lb (2000g)','A fórmula proteica do nosso100% Whey Isolate foi desenvolvida com dois grandes objetivos: fornecer a maior concentração possível de proteína numa fórmula aromatizada e permitir ao utilizador o consumo de uma proteína que provoque o afluxo mais rápido e significativo de aminoácidos ao músculo, impulsionando assim a síntese proteica anabólica',48.99,'100__Whey_Isolate_4_40lb__2000g__1496178302.jpg',2),(20,'Mutant Iso Surge 5 lb (2273g)','Mutants around the world have been asking us to create a whey protein isolate shake — and we listened. Formulated with high quality ingredients, Mutant Iso Surge is our new fast-acting Whey Protein Isolate & Hydrolysate formula with sinfully delicious flavours. We invested huge amounts of time and care crafting these flavours in our lab with Mutant athletes involved in the taste-testing process! We\'re now ready to share these exciting flavours with you. A surge of protein plus a surge of flavour — that\'s the Iso Surge one two advantage...pure and simple. We\'re confident that Iso Surge will be your go-to choice for all your whey isolate needs. Enjoy the surge!',58.99,'Mutant_Iso_Surge_5_lb__2273g__1496178341.jpg',2),(21,'Whey Protein 90 - 750 g','90% pure whey protein obtained by ion exchange, with added vitamins.\r\nWhey Protein 90 is a whey protein with 90% purity and low fat and starch content, that is highly soluble and digestible. The high protein content (90%) and solubility make it easy to use, ideal for maintaining muscle mass and protein supplementation. The low sodium content (200 mg per 100 g) makes Whey Protein 90 consistent even in the phase of muscle definition, while the substantially low level of lactose (less than 0.5%) makes it suitable even for those who are hypersensitiv',33.99,'Whey_Protein_90___750_g_1496178412.jpg',2),(22,'The Protein Ball Co. Vegan Protein 45 g','The Protein Ball Company Vegan Protein balls contains ten packs of delicious hand-made protein balls, which are lovingly made with pea and rice protein.\r\nThe Protein Ball Company Vegan Protein balls are the perfect on-the-go snack or post-workout fuel that your body needs to sustain a slow-release of energy. Each little ball has absolutely no artificial preservatives and is suitable for vegetarians.',2.69,'The_Protein_Ball_Co__Vegan_Protein_45_g_1496178509.jpg',3),(23,'12 x Protein Gourmet Bar 80 g','O Protein Gourmet Bar da Prozis é um snack incrivelmente delicioso, que combina chocolate, caramelo e avelãs numa barra rica em proteínas e pobre em calorias.',20.79,'12_x_Protein_Gourmet_Bar_80_g_1496178545.jpg',3),(24,'6 x Protein Bar 30 g','Protein bar, da WIN Nutrition, é a forma mais acessível, prática e deliciosa de consumir proteína a qualquer hora do dia.\r\nOs culturistas e os halterofilistas sabem que a proteína é um nutriente essencial no que diz respeito à reparação do tecido muscular. Um défice de proteína pode levar ao catabolismo muscular. A Protein bar, da WIN Nutrition, evita que isto aconteça ao garantir uma dose poderosa de proteína em cada barra. Também tem hidratos de carbono para acelerar o tempo de recuperação ao restabelecer os níveis de glicogénio nos músculos.',3.99,'6_x_Protein_Bar_30_g_1496178602.jpg',3),(25,'12 x Diet Bar 35 g','A guerra contra uma alimentação dietética sem sabor chegou ao fim! Apresentamos-te a Diet Bar da Prozis Diet, deliciosa e rica em proteína, a tua aliada para dietas de perda de peso.',17.88,'12_x_Diet_Bar_35_g_1496178647.jpg',3),(26,'Prime Casein 2.0 1250 g','Proteina casein da marca prozis.',24.99,'Prime_Casein_2_0_1250_g_1496178813.jpg',4),(27,'Scitec 100% Casein Complex 2350g','O 100% Casein Complex da Scitec é uma mistura de proteínas de leite onde predomina a caseína micelar, feita exclusivamente de proteínas de leite constituídas por caseína. A caseína tem alto teor de aminoácidos de cadeia ramificada (BCAA) e um teor ainda maior (maior do que a Whey ) de L-Glutamina, o aminoácido mais abundante no sangue humano.',48.99,'Scitec_100__Casein_Complex_2350g_1496178882.jpg',4),(28,'Elite Casein 4lb (1818g)','Dymatize Elite Casein fornece 24 gramas de proteína de Caseína de digestão lenta por dose. Dymatize 100% Casein foi especificamente desenvolvida para ser digerida mais lentamente pelo corpo, ao contrário das fontes de proteína de libertação rápida, como a whey. ',58.99,'Elite_Casein_4lb__1818g__1496178921.jpg',4),(29,'100% Casein 1 kg','Tal como a whey, a caseína é uma proteína de leite. Devido à sua estrutura molecular, tem uma propriedade de libertação gradual natural, que a torna ideal para tomar antes de dormir. Alimenta os músculos com aminoácidos de construção muscular durante toda a noite. É à noite que constróis músculo, dado que os níveis de hormona de crescimento atingem o pico cerca de duas horas após o início do sono. É extremamente importante que o teu organismo tenha energia e aminoácidos à sua disposição para sintetizar mais proteínas musculares. Por isso, certifica-te que dás ao teu corpo proteínas de libertação gradual da caseína e alguns hidratos de carbono de libertação gradual, da aveia por exemplo, antes de te deitares.',36.99,'100__Casein_1_kg_1496178961.jpg',4),(30,'Xtreme Mass Gainer SS 2722g','Durante anos, os atletas determinados a ganhar peso escolheram a Xcore Nutrition para lhes fornecer a forma mais conveniente e deliciosa de ingerir as enormes quantidades de calorias de que necessitam. E agora, damos-lhes ainda mais uma razão para manter a sua confiança: introduzindo o novo Xtreme Mass Gainer SS.',27.99,'Xtreme_Mass_Gainer_SS_2722g_1496179055.jpg',5),(31,'Real Mass Gainer 2722 g','Os mass gainers são suplementos imprescindíveis para todos os ectomorfos com dificuldade em aumentar a sua massa muscular através de uma alimentação normal. Estes produtos fornecem um excesso de calorias diárias, necessário para o crescimento de uma forma mais rápida e fácil.',26.99,'Real_Mass_Gainer_2722_g_1496179092.jpg',5),(32,'100% Hi-Mass Gainer Improved Flavour 5 lbs (2','Muitos atletas que treinam no duro para conseguir um corpo musculado deparam-se com uma triste realidade: independentemente do treino e da alimentação, a balança não se mexe. \r\nAs pessoas que têm um metabolismo acelerado costumam ter problemas em ganhar massa, porque os seus organismos tendem a utilizar os nutrientes com relativa rapidez.',19.99,'100__Hi_Mass_Gainer_Improved_Flavour_5_lbs__2_1496179140.jpg',5),(33,'Pure Maltodextrin D.E. 19 - 1500 g','Complex carbohydrates for sustained energy.\r\nMaltodextrins is a mixture of carbohydrates of a complex nature. +Watt Pure Maltodextrin D.E. 19 ensures a slow and steady release of energy over time.\r\nAfter exercise, Pure Maltodextrin D.E. 19 favors a faster restoration of muscle glycogen stores, hence shortening recovery time.',18.99,'Pure_Maltodextrin_D_E__19___1500_g_1496179237.jpg',6),(34,'Maltodextrina 2000g','A maltodextrina é um hidrato de carbono complexo com um elevado índice glicémico. É proveniente do milho, arroz ou fécula de batata. O facto de ser rapidamente digerida pelo corpo torna-a no suplemento ideal para tomar após treinos desgastantes, quando as reservas de glicogénio nos músculos estão esgotadas. Devido a este elevado índice glicémico, a maltodextrina é rapidamente absorvida na corrente sanguínea, sendo esta uma forma mais rápida de reabastecer os músculos.',9.99,'Maltodextrina_2000g_1496179278.jpg',6),(35,'Maltodextrina 2000 g','A maltodextrina é um hidrato de carbono complexo feito a partir de milho, arroz ou fécula de batata, mas a sua cadeia molecular é mais curta do que a de outros hidratos de carbono complexos. Tal como a dextrose, a maltodextrina é absorvida diretamente pelo intestino, aumentando índice glicémico do sangue e os níveis de insulina, tal como acontece com a dextrose.',12.99,'Maltodextrina_2000_g_1496179320.jpg',6),(36,'IsoCarb Professional 900 g','Força, velocidade, distância e tempo recorde… Com o IsoCarb da Prozis Sport Professional Series, não existem recordes imbatíveis. Esta bebida isotónica foi especificamente desenvolvida para atletas profissionais, fornecendo energia extra para treinos intensos, competições e desafios de resistência.',24.99,'IsoCarb_Professional_900_g_1496179378.jpg',7),(37,'Total Recovery 750 g','Victory Endurance\'s Total Recovery is a supplement specially designed for any athlete looking to maximize recovery after intensive training sessions. Each of its components has been selected and scientifically tested to provide optimal recovery, allowing you to improve your performance in competitions as well as in daily training sessions.',22.99,'Total_Recovery_750_g_1496179425.jpg',7),(38,'Total Recovery 750 g','Victory Endurance\'s Total Recovery is a supplement specially designed for any athlete looking to maximize recovery after intensive training sessions. Each of its components has been selected and scientifically tested to provide optimal recovery, allowing you to improve your performance in competitions as well as in daily training sessions.',22.99,'Total_Recovery_750_g_1496179469.jpg',7),(39,'Creatina micronizada 500 g','O Monohidrato de Creatina existe naturalmente no tecido muscular vermelho. A creatina é essencial para fornecer energia aos músculos e intensificar o desempenho atlético. A creatina aumenta os níveis de energia, a força muscular e a resistência - diminuindo a fadiga - e previne o esgotamento das fibras musculares, maximizando exponencialmente o aumento da força.',19.99,'Creatina_micronizada_500_g_1496179530.jpg',8),(40,'Monohidrato de Creatina 1000 g','A creatina é um aminoácido naturalmente presente na carne e no peixe, sendo ainda produzida pelo corpo humano no fígado, rins e pâncreas. É convertida em fosfato de creatina ou fosfocreatina e é armazenada nos músculos, sendo posteriormente utilizada para produzir energia. Durante o exercício físico de alta intensidade e curta duração, tal como levantamento de pesos ou corrida em velocidade, a fosfocreatina é convertida em ATP, uma fonte fundamental de energia no corpo humano.',24.99,'Monohidrato_de_Creatina_1000_g_1496179564.jpg',8),(41,'Monohidrato de Creatina 300 g','A creatina é uma substância endógena (produzida no organismo) que está presente em todas as células humanas, desempenhando uma função de grande importância no processo de produção de energia. A creatina é sintetizada essencialmente no fígado, rins e pâncreas, sendo posteriormente transportada para todas as células do corpo através da corrente sanguínea. A creatina está envolvida em todos os processos que requerem energia, principalmente na contração muscular. Entre 60 a 70% de toda a creatina disponível no organismo está armazenada em forma de fosfocreatina, uma importante fonte de energia. A creatina livre constitui os restantes 30 a 40%.',5.99,'Monohidrato_de_Creatina_300_g_1496179595.jpg',8),(42,'Creatina HCl 750 mg 90 cápsulas','Sendo uma das substâncias de melhoria do desempenho mais populares e mais estudadas, a creatina conquistou o seu lugar na elite da indústria dos suplementos, tornando-se num suplemento base do plano de nutrição de qualquer atleta.',14.99,'Creatina_HCl_750_mg_90_c__psulas_1496179672.jpg',9),(43,'Creatina HCl 90 cápsulas','A creatina HCl é o composto aminoácido que resulta da junção de um grupo cloridrato à creatina, criando assim um sal. Quando o grupo cloridrato se liga à creatina, a solubilidade da molécula aumenta substancialmente em comparação com a forma básica da creatina, chamada de monohidrato de creatina.',17.99,'Creatina_HCl_90_c__psulas_1496179787.jpg',9),(44,'Creatina HCl 750 mg 90 cápsulas','Sendo uma das substâncias de melhoria do desempenho mais populares e mais estudadas, a creatina conquistou o seu lugar na elite da indústria dos suplementos, tornando-se num suplemento base do plano de nutrição de qualquer atleta.',14.99,'Creatina_HCl_750_mg_90_c__psulas_1496179843.jpg',9),(45,'BCAA 8:1:1 Complex SS 180tabs','A Xcore desenvolveu o BCAA mais poderoso do mercado. Com uma combinação de leucina, isoleucina e valina num rácio especial de 8:1:1, este é o suplemento perfeito para aqueles que se submetem a sessões de treino intensas e exaustivas à procura de resultados sólidos.',19.99,'BCAA_8_1_1_Complex_SS_180tabs_1496179944.jpg',10),(46,'BCAA 8:1:1 SS 300 g','A Xcore desenvolveu um dos produtos de BCAAs mais poderosos do mercado. Com uma combinação de leucina, isoleucina e valina numa proporção especial de 8:1:1, este é o suplemento perfeito para aqueles que se submetem a sessões de treino intensas e exaustivas à procura de resultados concretos.',27.99,'BCAA_8_1_1_SS_300_g_1496179971.jpg',10),(47,'BCAA Powder 300g','BCAA Powder da XCORE Nutrition tem um equilíbrio excelente de Aminoácidos de Cadeia Ramificada : Leucina, Isoleucina e Valina. Os BCAA são aminoácidos essenciais que compõem até 35% da massa muscular corporal e desempenham um papel fundamental no crescimento e manutenção musculares, assim como no desenvolvimento e reparação dos tecidos. Os BCAA formam anticorpos, que reforçam o sistema imunitário, formam ARN e ADN e transportam o oxigénio até todas as partes do corpo.',23.99,'BCAA_Powder_300g_1496180016.jpg',10),(48,'Glutamina em Pó 500 g','A Glutamina pode ser muito útil para os atletas que praticam desportos onde a força, a velocidade e/ou a resistência são essenciais, como o futebol, o ciclismo, a corrida ou o ténis, visto que a Glutamina é essencial para os momentos em que o corpo está cansado ou sob grande stress, como, por exemplo, após um treino extenuante no ginásio ou após uma longa maratona.',24.99,'Glutamina_em_P___500_g_1496180079.jpg',11),(49,'L-Glutamina 150 g','Dos vários aminoácidos que compõem as nossas fibras musculares, a Glutamina é o mais abundante de todos. Os nossos músculos armazenam mais Glutamina do que qualquer outro aminoácido, o que a torna numa parte fundamental da nossa estrutura muscular.',6.99,'L_Glutamina_150_g_1496180110.jpg',11),(50,'Glutamina + 300 g','A glutamina é um dos aminoácidos que compõem o tipo de proteína que encontramos normalmente em produtos alimentares. Este aminoácido específico é o mais abundante no nosso tecido muscular e as nossas células armazenam-no, de modo a preservar a sua integridade estrutural.',12.99,'Glutamina___300_g_1496180142.jpg',11),(51,'L-Arginina 2400 mg 90 comprimidos','A arginina é vital para a produção de óxido nítrico (N.O.), a substância responsável pela vasodilatação.\r\nA arginina é também um aminoácido condicionalmente essencial, o que significa que, apesar de o nosso organismo ser capaz de a produzir, às vezes são necessárias quantidades maiores de arginina, que um suplemento alimentar de alta qualidade, tal como o L-Arginine da Prozis, pode fornecer.',9.99,'L_Arginina_2400_mg_90_comprimidos_1496180204.jpg',12),(52,'Mega L-Arginine 100 caps','Pack de 100 caps de Arginina da melhor qualidade.',15.99,'Mega_L_Arginine_100_caps_1496180264.jpg',12),(53,'L-Arginina 300 g','A arginina é vital para a produção de óxido nítrico (N.O.), a substância responsável pela vasodilatação.\r\nA arginina é também um aminoácido condicionalmente essencial, o que significa que, apesar de o nosso organismo ser capaz de a produzir, às vezes são necessárias quantidades maiores de arginina, que um suplemento alimentar de alta qualidade, tal como o L-Arginine da Prozis Sport, pode fornecer.',16.99,'L_Arginina_300_g_1496180295.jpg',12),(54,'Amino Leucine 200 g','Um aminoácido muito eficaz para aqueles que querem ganhar músculo rapidamente. Envia um sinal aos músculos a informar que existe muita proteína no organismo, o que aumenta a síntese proteica. Podemos dizer que o organismo utiliza o nível de leucina no sangue como um indicador da quantidade de proteína disponível. Quanto mais elevado o nível de leucina, mais eficaz será o progresso. Outra característica é que produz cetonas, energia para o cérebro, para manter a tua concentração em níveis ótimos durante um treino intenso ou uma dieta rígida.',17.99,'Amino_Leucine_200_g_1496180400.jpg',13),(55,'L-Leucina instantânea 300 g','A L-leucina é um aminoácido absolutamente fundamental para a construção muscular. É um dos três aminoácidos que compõem o complexo denominado Aminoácidos de Cadeia Ramificada (BCAA). A L-leucina é essencial para o organismo. Uma vez que não a conseguimos produzir internamente, devemos obtê-la através da alimentação ou da suplementação.',14.99,'L_Leucina_instant__nea_300_g_1496180428.jpg',13),(56,'Leucina 100 cápsulas','Scitec L-leucine é um suplemento de Leucina, um dos aminoácidos essenciais que pertence ao grupo dos BCAA. Estudos científicos recentes mostraram que a Leucina é um dos aminoácidos mais importantes, pois estimula diretamente a síntese proteica do músculo esquelético, ou seja, o nível de Leucina no corpo estimula o estado anabólico.',6.95,'Leucina_100_c__psulas_1496180456.jpg',13),(57,'Animal M-Stak 21 packs + Animal Pump 30 Packs','O que é o anabolismo? Síntese proteica. Retenção de nitrogénio. \"Partição de nutrientes\". O novo Animal M-Stak é um suplemento natural que ajuda a reforçar o anabolismo e a aperfeiçoá-lo, para o atleta ambicioso que todos temos dentro de nós.',69.89,'Animal_M_Stak_21_packs___Animal_Pump_30_Packs_1496180522.jpg',14),(58,'Amino Build Next Gen 30 servings','Branched chain amino acids (BCAAs) have been used by top bodybuilders and other athletes for years due to their ability to support training endurance and recovery! BCAAs are comprised of 3 powerful amino acids – leucine, isoleucine and valine – and are perfect for any hard-training athletes because they serve as primary building blocks for muscle and help combat muscle loss and protein breakdown, especially during intense training',24.95,'Amino_Build_Next_Gen_30_servings_1496180671.jpg',14),(59,'L-Arginina 2400 mg 90 comprimidos','A arginina é vital para a produção de óxido nítrico (N.O.), a substância responsável pela vasodilatação.\r\nA arginina é também um aminoácido condicionalmente essencial, o que significa que, apesar de o nosso organismo ser capaz de a produzir, às vezes são necessárias quantidades maiores de arginina, que um suplemento alimentar de alta qualidade, tal como o L-Arginine da Prozis, pode fornecer.',9.99,'L_Arginina_2400_mg_90_comprimidos_1496180804.jpg',14),(60,'Citrulline Malate 90 caps','A citrulina é combinada com o ácido málico para formar o malato de citrulina. O aminoácido citrulina está presente na melancia (Citrullus lanatus), ao passo que o ácido málico é um ácido orgânico abundante na natureza (por exemplo, na fruta). Muitas proteínas contêm citrulina e ambos os ingredientes são intermediários-chave nos ciclos metabólicos.',16.99,'Citrulline_Malate_90_caps_1496180998.jpg',16),(61,'Sports Citrulline Malate 200 g','HAYA Sports Citrulline Malate is a sports supplement with 100% citruline malate – an ingredient, which reduces fatigue, supports recovery after intense trainings and improves sport results. Citruline Malate delivers more strength and endurance.',14.99,'Sports_Citrulline_Malate_200_g_1496181054.jpg',16),(62,'L-Citrulline Malate 500 g','ESN L-Citrulline Malate is a very high-quality pump supplement for bodybuilders and athletes, as it can strengthen the muscle pump in muscle training. L-Citrulline is similar to the amino acid L-Arginine.',37.99,'L_Citrulline_Malate_500_g_1496181112.jpg',16),(63,'Beta Alanina 100 cápsulas','\r\nAdie a fadiga muscular e aumente a sua força com XCORE Beta Alanine\r\nA Beta-Alanina é um aminoácido não essencial, útil para os desportistas - profissionais e amadores - que desejam aumentar a sua força e resistência durante o treino. A falta deste aminoácido pode limitar uma atividade de longa duração. A função da Beta alanina é aumentar os níveis de carnosina nos músculos, o que ajuda a prolongar a força por muito mais tempo.',12.99,'Beta_Alanina_100_c__psulas_1496181318.jpg',17),(64,'Beta Alanina 200 g','A beta-alanina é um aminoácido precursor do dipéptido carnosina ; por outras palavras, é fundamental para a produção de carnosina. A carnosina desempenha um importante papel na manutenção do pH muscular. Funciona como uma esponja, neutralizando os iões de hidrogénio que se acumulam durante o exercício físico intenso e impedem os músculos de se contraírem eficazmente, acabando por gerar fadiga muscular e diminuir os níveis de força.',12.99,'Beta_Alanina_200_g_1496181372.jpg',17),(65,'Beta-Alanina 90 cáp.','Suplemento alimentar à base de beta-alanina, um aminoácido não essencial que ocupa um lugar especial entre o grupo dos aminoácidos. Trata-se de uma ajuda ergogénica eficaz que aumenta a força muscular, ao mesmo tempo que exerce um efeito antioxidante significativo.',15.25,'Beta_Alanina_90_c__p__1496181403.jpg',17);
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professor`
--

DROP TABLE IF EXISTS `professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `BI` int(11) NOT NULL,
  `Contribuinte` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `DataNascimento` int(11) NOT NULL,
  `Foto` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professor`
--

LOCK TABLES `professor` WRITE;
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
INSERT INTO `professor` VALUES (1,'Daniel Silverio',121234345,123234233,'DanielSilverio@gmail.com',1,'images_1499077978.png'),(2,'Afonso Alvim',123234567,345645566,'AfonsoAlvim@gmail.com',1,'images_1499078012.png'),(6,'Helena Gonçalves',546564564,676755675,'HelenaGonçalves@gmail.com',1,'images_1499078025.png');
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refeicao`
--

DROP TABLE IF EXISTS `refeicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refeicao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Hora` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refeicao`
--

LOCK TABLES `refeicao` WRITE;
/*!40000 ALTER TABLE `refeicao` DISABLE KEYS */;
INSERT INTO `refeicao` VALUES (1,7),(2,10),(3,13),(4,16),(5,19),(6,22);
/*!40000 ALTER TABLE `refeicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registo`
--

DROP TABLE IF EXISTS `registo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Data` int(11) NOT NULL,
  `OutrosDetalhes` varchar(200) DEFAULT NULL,
  `Cliente_id` int(11) NOT NULL,
  `Estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_Registo_Clientes1_idx` (`Cliente_id`),
  CONSTRAINT `fk_Registo_Clientes1` FOREIGN KEY (`Cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registo`
--

LOCK TABLES `registo` WRITE;
/*!40000 ALTER TABLE `registo` DISABLE KEYS */;
INSERT INTO `registo` VALUES (54,1499046003,'',35,1),(55,1499046012,'',36,1),(56,1499046048,'',35,1),(57,1499046059,'',36,1),(58,1499076747,'',37,1),(59,1499076755,'',37,1);
/*!40000 ALTER TABLE `registo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sala`
--

DROP TABLE IF EXISTS `sala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sala` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `Lotacao` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sala`
--

LOCK TABLES `sala` WRITE;
/*!40000 ALTER TABLE `sala` DISABLE KEYS */;
INSERT INTO `sala` VALUES (1,'Sala 201',10),(2,'Sala 203',10);
/*!40000 ALTER TABLE `sala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguro`
--

DROP TABLE IF EXISTS `seguro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seguro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Renovacao` int(11) NOT NULL,
  `DataCriacao` int(11) NOT NULL,
  `Estado` int(1) NOT NULL DEFAULT '1',
  `Cliente_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Seguro_Cliente1_idx` (`Cliente_id`),
  CONSTRAINT `fk_Seguro_Cliente1` FOREIGN KEY (`Cliente_id`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguro`
--

LOCK TABLES `seguro` WRITE;
/*!40000 ALTER TABLE `seguro` DISABLE KEYS */;
INSERT INTO `seguro` VALUES (23,0,1499045713,1,35),(24,0,1499045830,1,36),(25,0,1499076669,1,37),(26,0,1499077030,1,38);
/*!40000 ALTER TABLE `seguro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessao`
--

DROP TABLE IF EXISTS `sessao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `PrimeiraSessao` int(11) NOT NULL,
  `SegundaSessao` int(11) NOT NULL,
  `Duracao` int(11) NOT NULL,
  `Descricao` varchar(150) NOT NULL,
  `Sala_id` int(11) NOT NULL,
  `Aula_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Sessao_Sala1_idx` (`Sala_id`),
  KEY `fk_Sessao_Aulas1_idx` (`Aula_id`),
  CONSTRAINT `fk_Sessao_Aulas1` FOREIGN KEY (`Aula_id`) REFERENCES `aula` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Sessao_Sala1` FOREIGN KEY (`Sala_id`) REFERENCES `sala` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessao`
--

LOCK TABLES `sessao` WRITE;
/*!40000 ALTER TABLE `sessao` DISABLE KEYS */;
INSERT INTO `sessao` VALUES (5,1492542000,1492628400,7200,'sadfas asda ',2,1),(6,1492506000,1492596000,7200,'asdasd ada',1,2),(8,1491984000,1492516800,3600,'asdasd',1,4),(9,1491980400,1492761600,3600,'asdfasdf asdf asdfs df s',2,4),(10,1495090800,1495904400,7200,'Cenas maradas',1,3),(11,1495450800,1495022400,3600,'asdfasd fsdfsadfsgdf hsd',1,2),(12,1498896000,1499173200,7200,'cenas',1,3);
/*!40000 ALTER TABLE `sessao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategoriaproduto`
--

DROP TABLE IF EXISTS `subcategoriaproduto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategoriaproduto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  `CategoriaProdutos_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Produtos_CategoriaProdutos1_idx` (`CategoriaProdutos_id`),
  CONSTRAINT `fk_Produtos_CategoriaProdutos1` FOREIGN KEY (`CategoriaProdutos_id`) REFERENCES `categoriaproduto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategoriaproduto`
--

LOCK TABLES `subcategoriaproduto` WRITE;
/*!40000 ALTER TABLE `subcategoriaproduto` DISABLE KEYS */;
INSERT INTO `subcategoriaproduto` VALUES (1,'Proteína Whey',1),(2,'Isolado de Whey',1),(3,'Snacks Proteicos',1),(4,'Caseína',1),(5,'Gainers',2),(6,'Maltodextrina e Dextrose',2),(7,'Hidratos de Carbono',2),(8,'Monohidrato de Creatina',3),(9,'Alta Biodisponibilidade',3),(10,'BCAAs',4),(11,'Glutamina',4),(12,'Arginina',4),(13,'Leucina',4),(14,'Óxido Nitrico',5),(16,'Citrulina',5),(17,'Beta Alanina',5);
/*!40000 ALTER TABLE `subcategoriaproduto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(10) NOT NULL DEFAULT '10',
  `role` smallint(10) DEFAULT '10',
  `auth_key` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Username_UNIQUE` (`username`),
  UNIQUE KEY `Email_UNIQUE` (`email`),
  UNIQUE KEY `password_reset_token_UNIQUE` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (5,'admin','$2y$13$yRvVz2rfmhOM25GWh2o1beHwqOL92XYbxSy9iQCzvBNM2Ne1vmBda','admin@mygym.com',10,20,'_nvfv_t0Q-gwPHbPkqK77ahmAlZY7pst',1492628391,NULL,1492628391),(43,'10','$2y$13$itHWiHuqZ1NOTrk0DN31/eQ/BAGIpHDESKnrP.tZn86fIQwDe7XEW','kunhacbt@gmail.com',10,10,'Vkl_1iBtfqGBozQDLCXVM31nP67H3kHA',1499045713,NULL,1499047198),(44,'11','$2y$13$8e6F4gH3Ye5UhEqPQ5nuq.rXAhOnzQJhCxS9XC2XH..1ByWGQJASO','kunhacbt2@gmail.com',10,10,'0woMbhjX24Or4ldzgWbZuUNq1o60b4JH',1499045830,NULL,1499045830),(45,'12','$2y$13$Tg.9cQAus.KlHLK7BdSwFOKcOXuzxxUWmmoB7Po2xlvSqNXUEqbNO','patrick_jose_00@hotmail.com',10,10,'7gTIktfhmXeDnKLKaqTK69SSAPwUuPDO',1499076669,NULL,1499076669),(46,'14','$2y$13$Ik0z9Br7rUG3E0C9xTnGsu32VraF8V5YxzgEnkFQ7nClVt5.j1a/S','patrick_jose_02@hotmail.com',10,10,'yGrFl7iG5k_32UbEFJYZ8Kz5cIf75bI5',1499077030,NULL,1499077030);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valorseguro`
--

DROP TABLE IF EXISTS `valorseguro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valorseguro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Preco` decimal(4,2) NOT NULL,
  `DataCriacao` int(11) NOT NULL,
  `Estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valorseguro`
--

LOCK TABLES `valorseguro` WRITE;
/*!40000 ALTER TABLE `valorseguro` DISABLE KEYS */;
INSERT INTO `valorseguro` VALUES (1,23.00,1497118193,0),(3,22.00,1497121345,0),(4,10.00,1497121354,0),(5,20.00,1498240693,1);
/*!40000 ALTER TABLE `valorseguro` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-03 13:24:28
