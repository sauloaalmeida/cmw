drop table if exists even_inscricao;
drop table if exists even_imagem;
drop table if exists even_anexo;
drop table if exists even_evento;
drop table if exists aniv_aniversario;
drop table if exists menu_link;
drop table if exists nwsl_usuario;
drop table if exists nwsl_envio;
drop table if exists nwsl_template;
drop table if exists news_imagem;
drop table if exists news_anexo;
drop table if exists news_noticia;
drop table if exists news_categoria;
drop table if exists idi_idioma;
drop table if exists enq_voto;
drop table if exists enq_resposta;
drop table if exists enq_enquete;
drop table if exists enq_categoria;
drop table if exists adm_usuario;
drop table if exists tipo_anexo;


CREATE TABLE tipo_anexo (
  tipo_anx_pk int unsigned NOT NULL auto_increment,
  tipo_anx_nome varchar(50) NOT NULL,
  tipo_anx_descricao varchar(255) NOT NULL,
  tipo_anx_extensao varchar(10) NOT NULL,
  tipo_anx_icone varchar(100) NOT NULL ,
  PRIMARY KEY  (tipo_anx_pk)
) ENGINE=InnoDB;

CREATE TABLE adm_usuario (
  adm_usr_pk int unsigned NOT NULL auto_increment,
  adm_usr_login varchar(20) NOT NULL,
  adm_usr_nome varchar(100) NOT NULL,
  adm_usr_senha varchar(50) NOT NULL,
  adm_usr_email varchar(50) NOT NULL,
  adm_usr_nivel char(1) NOT NULL,
  adm_usr_status char(1) NOT NULL,
  PRIMARY KEY  (adm_usr_pk)
) ENGINE=InnoDB COMMENT='adm_usr_status: A = Ativo, I = Inativo / adm_usr_nivel: E = ';


CREATE TABLE enq_categoria (
  enq_cat_pk int unsigned NOT NULL auto_increment,
  enq_cat_nome varchar(100) NOT NULL,
  enq_cat_descricao varchar(255) NOT NULL,
  PRIMARY KEY  (enq_cat_pk)
) ENGINE=InnoDB;


CREATE TABLE enq_enquete (
  enq_enq_pk int unsigned NOT NULL auto_increment,
  enq_enq_pergunta varchar(255) NOT NULL ,
  enq_enq_tp_resposta char(1) NOT NULL ,
  enq_enq_resultado_porcentagem char(1) NOT NULL,
  enq_enq_resultado_absoluto char(1) NOT NULL,
  enq_enq_duracao_voto int(10) unsigned NOT NULL ,
  enq_enq_dt_criacao datetime NOT NULL ,
  enq_enq_dt_inicio datetime NOT NULL ,
  enq_enq_dt_fim datetime NOT NULL ,
  enq_cat_fk int unsigned NOT NULL ,
  adm_usr_fk int unsigned NOT NULL ,
  PRIMARY KEY  (enq_enq_pk),
  KEY fk_enq_categoria_enq_enquete (enq_cat_fk),
  KEY fk_adm_usuario_enq_enquete (adm_usr_fk),
  CONSTRAINT cstr_enq_categoria_enq_enquete FOREIGN KEY (enq_cat_fk) REFERENCES enq_categoria (enq_cat_pk),
  CONSTRAINT cstr_adm_usuario_enq_enquete FOREIGN KEY (adm_usr_fk) REFERENCES adm_usuario (adm_usr_pk)
) ENGINE=InnoDB ;


CREATE TABLE enq_resposta (
  enq_resp_pk int unsigned NOT NULL auto_increment,
  enq_resp_resposta varchar(100) NOT NULL,
  enq_enq_fk int unsigned NOT NULL ,
  PRIMARY KEY  (enq_resp_pk),
  KEY fk_enq_enquete_enq_resposta (enq_enq_fk),
  CONSTRAINT cstr_enq_enquete_enq_resposta FOREIGN KEY (enq_enq_fk) REFERENCES enq_enquete (enq_enq_pk)
) ENGINE=InnoDB ;


CREATE TABLE enq_voto (
  enq_voto_pk int unsigned NOT NULL auto_increment,
  enq_voto_ip varchar(23) NOT NULL,
  enq_voto_dt_votacao datetime NOT NULL ,
  enq_resp_fk int unsigned NOT NULL ,
  PRIMARY KEY  (enq_voto_pk),
  KEY fk_enq_resposta_enq_voto (enq_resp_fk),
  CONSTRAINT cstr_enq_resposta_enq_voto FOREIGN KEY (enq_resp_fk) REFERENCES enq_resposta (enq_resp_pk)
) ENGINE=InnoDB;


CREATE TABLE idi_idioma (
  idi_idioma_pk int unsigned NOT NULL auto_increment,
  idi_nome varchar(30) NOT NULL ,
  idi_descricao varchar(255) NOT NULL,
  idi_imagem varchar(100) NOT NULL ,
  PRIMARY KEY  (idi_idioma_pk)
) ENGINE=InnoDB;


CREATE TABLE news_categoria (
  news_cat_pk int unsigned NOT NULL auto_increment,
  news_cat_nome varchar(100) NOT NULL,
  news_cat_descricao varchar(255) NOT NULL,
  news_cat_url varchar(60) NULL,
  news_cat_pai_fk int unsigned NULL,
  PRIMARY KEY  (news_cat_pk),
  KEY fk_news_categoria_news_categoria (news_cat_pai_fk),
  CONSTRAINT cstr_news_categoria_news_categoria FOREIGN KEY (news_cat_pai_fk) REFERENCES news_categoria (news_cat_pk)    
) ENGINE=InnoDB;


CREATE TABLE news_noticia (
  news_not_pk int unsigned NOT NULL auto_increment,
  news_not_titulo varchar(100) NOT NULL,
  news_not_target varchar(30)  NULL,
  news_not_destaque char(1) NOT NULL,
  news_not_corpo text NOT NULL,
  news_not_chamada varchar(255)  NULL,
  news_not_link varchar(255)  NULL,
  news_not_origem varchar(100) NOT NULL,
  news_not_autor varchar(100) NOT NULL,
  news_not_dt_criacao datetime NOT NULL,
  news_not_dt_inicio datetime NOT NULL,
  news_not_dt_fim datetime NULL,
  news_cat_fk int unsigned NOT NULL,
  adm_usr_fk int unsigned NOT NULL,
  idi_idioma_fk int unsigned NOT NULL,
  news_not_status char(1) NOT NULL,
  PRIMARY KEY  (news_not_pk),
  KEY fk_news_categoria_news_noticia (news_cat_fk),
  KEY fk_adm_usuario_news_noticia (adm_usr_fk),
  KEY fk_idi_idioma_news_noticia (idi_idioma_fk),
  CONSTRAINT cstr_news_categoria_news_noticia FOREIGN KEY (news_cat_fk) REFERENCES news_categoria (news_cat_pk),
  CONSTRAINT cstr_adm_usuario_news_noticia FOREIGN KEY (adm_usr_fk) REFERENCES adm_usuario (adm_usr_pk),
  CONSTRAINT cstr_idi_idioma_news_noticia FOREIGN KEY (idi_idioma_fk) REFERENCES idi_idioma (idi_idioma_pk)
) ENGINE=InnoDB COMMENT='news_not_status: A = Ativo, R = Rascunho';


CREATE TABLE news_anexo (
  news_anx_pk int unsigned NOT NULL auto_increment,
  news_anx_titulo varchar(100) NOT NULL,
  news_anx_descricao varchar(255) NOT NULL ,
  news_anx_dt_cadastro datetime NOT NULL ,
  news_anx_path varchar(100) NOT NULL ,
  news_anx_credito varchar(100) NULL,
  tipo_anx_fk int unsigned NOT NULL,
  news_not_fk int unsigned NOT NULL,
  PRIMARY KEY  (news_anx_pk),
  KEY fk_tipo_anexo_news_anexo (tipo_anx_fk),
  KEY fk_news_noticia_news_anexo (news_not_fk),
  CONSTRAINT cstr_tipo_anexo_news_anexo FOREIGN KEY (tipo_anx_fk) REFERENCES tipo_anexo (tipo_anx_pk),
  CONSTRAINT cstr_news_noticia_news_anexo FOREIGN KEY (news_not_fk) REFERENCES news_noticia (news_not_pk)
) ENGINE=InnoDB;



CREATE TABLE news_imagem (
  news_img_pk int unsigned NOT NULL auto_increment,
  news_img_titulo varchar(100) NOT NULL ,
  news_img_destaque char(1) NOT NULL ,
  news_img_descricao varchar(255) NOT NULL ,
  news_img_dt_cadastro datetime NOT NULL ,
  news_img_path1 varchar(100) NOT NULL ,
  news_img_path2 varchar(100)  NULL,
  news_img_credito varchar(100)  NULL,
  news_not_fk int unsigned NOT NULL,
  PRIMARY KEY  (news_img_pk),
  KEY fk_news_noticia_news_imagem (news_not_fk),
  CONSTRAINT cstr_news_noticia_news_imagem FOREIGN KEY (news_not_fk) REFERENCES news_noticia (news_not_pk)
) ENGINE=InnoDB;


CREATE TABLE nwsl_template (
  nwsl_temp_pk int unsigned NOT NULL auto_increment,
  nwsl_temp_nome varchar(30) NOT NULL,
  nwsl_temp_path varchar(255) NOT NULL,
  PRIMARY KEY  (nwsl_temp_pk)
) ENGINE=InnoDB;



CREATE TABLE nwsl_envio (
  nwsl_env_pk int unsigned NOT NULL auto_increment,
  nwsl_env_assunto varchar(255) NOT NULL,
  nwsl_env_path varchar(255) NULL,
  nwsl_env_corpo text,
  nwsl_env_status char(1) NOT NULL ,
  nwsl_env_dt_cadastro datetime NOT NULL ,
  nwsl_env_dt_envio datetime  NULL,
  nwsl_temp_fk int unsigned NULL,
  PRIMARY KEY  (nwsl_env_pk),
  KEY fk_nwsl_template_nwsl_envio (nwsl_temp_fk),
  CONSTRAINT cstr_nwsl_template_nwsl_envio FOREIGN KEY (nwsl_temp_fk) REFERENCES nwsl_template (nwsl_temp_pk)  
) ENGINE=InnoDB ;



CREATE TABLE nwsl_usuario (
  nwsl_usr_pk int unsigned NOT NULL auto_increment,
  nwsl_usr_nome varchar(100) NOT NULL ,
  nwsl_usr_email varchar(255) NOT NULL,
  nwsl_usr_dt_cadastro datetime NOT NULL ,
  PRIMARY KEY  (nwsl_usr_pk),
  KEY nwsl_usr_pk (nwsl_usr_pk)
) ENGINE=InnoDB;

CREATE TABLE menu_link (
  menu_link_pk int unsigned NOT NULL auto_increment,
  menu_link_nome varchar(100) NOT NULL,
  menu_link_descricao varchar(255) NULL,      
  menu_link_path varchar(255) NULL,    
  menu_link_url varchar(255) NULL,
  menu_link_target varchar(30) NULL,
  menu_link_ordem int unsigned NOT NULL,  
  menu_link_pai_fk int unsigned NULL,
  PRIMARY KEY  (menu_link_pk),
  KEY fk_menu_link_menu_link (menu_link_pai_fk),
  CONSTRAINT cstr_menu_link_menu_link FOREIGN KEY (menu_link_pai_fk) REFERENCES menu_link (menu_link_pk)    
) ENGINE=InnoDB;


CREATE TABLE aniv_aniversario (
  aniv_aniv_pk int unsigned NOT NULL auto_increment,
  aniv_aniv_nome varchar(100) NOT NULL,
  aniv_aniv_dt_nasc date  NULL,  
  PRIMARY KEY  (aniv_aniv_pk)
) ENGINE=InnoDB;

CREATE TABLE even_evento(
 even_even_pk int unsigned NOT NULL auto_increment,
 even_even_nome varchar(100) NOT NULL,  
 even_even_chamada varchar(255) NULL,  
 even_even_destaque char(1) NOT NULL,
 even_even_link varchar(255) NULL,   
 even_even_tipo char(1) NOT NULL,  
 even_even_inscricao char(1) NOT NULL,  
 even_even_corpo text NOT NULL,  
 even_even_dt_inicio date NOT NULL, 
 even_even_dt_fim date NOT NULL,  
 even_even_dt_inicio_publicacao datetime NOT NULL, 
 even_even_dt_fim_publicacao datetime NOT NULL, 
 even_even_status char(1) NOT NULL,  
 PRIMARY KEY  (even_even_pk)
) ENGINE=InnoDB COMMENT='even_even_tipo: I = Interno, E = Externo';

CREATE TABLE even_anexo (
  even_anx_pk int unsigned NOT NULL auto_increment,
  even_anx_titulo varchar(100) NOT NULL,
  even_anx_descricao varchar(255) NOT NULL ,
  even_anx_dt_cadastro datetime NOT NULL ,
  even_anx_path varchar(100) NOT NULL ,
  even_anx_credito varchar(100) NULL,
  tipo_anx_fk int unsigned NOT NULL ,
  even_even_fk int unsigned NOT NULL,
  PRIMARY KEY  (even_anx_pk),
  KEY fk_tipo_anexo_even_anexo (tipo_anx_fk),
  KEY fk_even_evento_even_anexo (even_even_fk),
  CONSTRAINT cstr_even_tipo_anexo_even_anexo FOREIGN KEY (tipo_anx_fk) REFERENCES tipo_anexo (tipo_anx_pk),
  CONSTRAINT cstr_even_evento_even_anexo FOREIGN KEY (even_even_fk) REFERENCES even_evento (even_even_pk)
) ENGINE=InnoDB;

CREATE TABLE even_imagem (
  even_img_pk int unsigned NOT NULL auto_increment,
  even_img_titulo varchar(100) NOT NULL ,
  even_img_destaque char(1) NOT NULL ,
  even_img_descricao varchar(255) NOT NULL ,
  even_img_dt_cadastro datetime NOT NULL ,
  even_img_path1 varchar(100) NOT NULL ,
  even_img_path2 varchar(100)  NULL,
  even_img_credito varchar(100)  NULL,
  even_even_fk int unsigned NOT NULL,
  PRIMARY KEY  (even_img_pk),
  KEY fk_even_evento_even_imagem (even_even_fk),
  CONSTRAINT cstr_even_evento_even_imagem FOREIGN KEY (even_even_fk) REFERENCES even_evento (even_even_pk)
) ENGINE=InnoDB;


CREATE TABLE even_inscricao(
  even_insc_pk int unsigned NOT NULL auto_increment, 
  even_insc_nome varchar(100) NOT NULL,
  even_insc_crmv varchar(30) NULL,
  even_insc_dt_inscricao datetime NOT NULL,
  even_insc_tipo_inscrito char(1) NOT NULL ,
  even_insc_tel varchar(12) NOT NULL,
  even_insc_cel varchar(12) NOT NULL,
  even_insc_email varchar(100) NULL,   
  even_even_fk int unsigned NOT NULL,
  PRIMARY KEY  (even_insc_pk),
  KEY fk_even_evento_even_inscricao (even_even_fk),
  CONSTRAINT cstr_even_evento_even_inscricao FOREIGN KEY (even_even_fk)  REFERENCES even_evento (even_even_pk)
) ENGINE=InnoDB;