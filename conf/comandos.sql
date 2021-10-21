CREATE TABLE `carro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45),
  `valor` double,
  `km` double,
  `datafabricacao` date,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

INSERT INTO `ifc`.`carro` (`nome`, `valor`, `km`, `datafabricacao`) VALUES ('Toro Freedom', '13.890', '112.000', '2021-04-08');
INSERT INTO `ifc`.`carro` (`nome`, `valor`, `km`, `datafabricacao`) VALUES ('Cruze', '120.680', '12.704', '2014-02-12');
INSERT INTO `ifc`.`carro` (`nome`, `valor`, `km`, `datafabricacao`) VALUES ('Onix', '38.990', '18.980', '2015-06-23');
INSERT INTO `ifc`.`carro` (`nome`, `valor`, `km`, `datafabricacao`) VALUES ('KA', '54.900', '45.000', '1978-05-21');
INSERT INTO `ifc`.`carro` (`nome`, `valor`, `km`, `datafabricacao`) VALUES ('Jetta', '66.900', '0', '2012-08-02');
INSERT INTO `ifc`.`carro` (`nome`, `valor`, `km`, `datafabricacao`) VALUES ('Fusca', '31.000', '320.000', '1973-09-30');