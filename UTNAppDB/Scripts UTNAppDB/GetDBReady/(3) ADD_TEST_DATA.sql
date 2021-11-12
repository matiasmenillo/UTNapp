/* (CORRER LUEGO DE LEVANTAR LA API DESDE LOGIN EN APP) */

CALL InsertCompany(1, 'Software', 'EDSA', 'Empresa Tandilense', 1111111111, 'WWW.EDSA.COM.AR', 'Estrategias Diferenciadas S.A');
CALL InsertCompany(1, 'Software', 'Globant', 'Empresa Internacional', 222222222, 'WWW.Globant.COM.AR', 'Globant Company');
CALL InsertCompany(1, 'Software', 'Accenture', 'Empresa Internacional 2', 333333333, 'WWW.Accenture.COM.AR', 'Accenture Company');

CALL InsertJobOffer(1, (SELECT IdCompany FROM Company WHERE Name = 'EDSA'));
CALL InsertJobOffer(6, (SELECT IdCompany FROM Company WHERE Name = 'Globant'));
CALL InsertJobOffer(8, (SELECT IdCompany FROM Company WHERE Name = 'Accenture'));