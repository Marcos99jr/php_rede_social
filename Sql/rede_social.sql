	create schema rede_social default charset utf8;
    
    use rede_social;


	create table Perfil (
		
        id int not null,
        nome varchar(40),
        sobrenome varchar(40),
        sexo varchar(1),
        email varchar(50),
        usuario varchar(30),
        sangue varchar(3),
        cad_data date not null,
        senha varchar(200),
        startus varchar(20),
	
		primary key (id)
        
	);
    
    create table Amizade(
    amigo int not null,
    amigo_visit int not null,
	mensagem varchar(700),
    situacao varchar(50),
    foreign key (amigo) references Perfil(id),
	foreign key (amigo_visit) references Perfil (id),
	primary key(amigo,amigo_visit)
    );
    
    UPDATE Perfil 
    set startus = 'necessitado' 
    where id=2;
    
	select * from Perfil;	
    select * from Amizade;	
    SELECT amigo from Amizade where amigo_visit=2 and situacao='confirmado' and amigo!=2;
    
    SELECT amigo_visit from Amizade where amigo=2 and situacao='confirmado' and amigo_visit!=2;
    select * from Perfil where usuario like 'Marc';   