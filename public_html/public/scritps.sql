--scripts versão 1.0.0.2

ALTER TABLE `material` ADD `Usuarios_Siape` INT NOT NULL , ADD INDEX `fk_usuarios_Siape` (`Usuarios_Siape`);

ALTER TABLE `baixamat` ADD `situacaomat_idSituacaoMat` INT NOT NULL AFTER `qtdBaixa`, ADD INDEX `fk_situacaoMat_idSituacaoMat` (`situacaomat_idSituacaoMat`);

