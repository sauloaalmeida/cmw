
INSERT INTO adm_usuario (adm_usr_login, adm_usr_nome, adm_usr_senha, adm_usr_email, adm_usr_nivel, adm_usr_status) VALUES ('saulo.saa', 'Saulo Andrade Almeida', password('redtable7'), 'saulo@ibahia.com', 'A', 'A');
INSERT INTO adm_usuario (adm_usr_login, adm_usr_nome, adm_usr_senha, adm_usr_email, adm_usr_nivel, adm_usr_status) VALUES ('gfjourdan', 'Gabriel Ferreira Jourdan', password('123456'), 'gfjordan@ig.com.br', 'A', 'A');

INSERT INTO idi_idioma (idi_nome, idi_descricao, idi_imagem ) VALUES ('Portugues', 'Lingua Portuguesa', '/sistema/nucleo/imgs/bandeira_portugues.gif');

INSERT INTO news_categoria (news_cat_nome, news_cat_descricao, news_cat_pai_fk) VALUES ('Raiz', 'Raiz das categorias', NULL);
INSERT INTO news_categoria (news_cat_nome, news_cat_descricao, news_cat_pai_fk) VALUES ('P&aacute;ginas site', 'Area de conteudo do site', 1); 

INSERT INTO tipo_anexo (tipo_anx_nome, tipo_anx_descricao, tipo_anx_extensao, tipo_anx_icone) VALUES ( 'Video AVI', 'Arquivo de video formato AVI', 'AVI', 'ext_avi.gif');
INSERT INTO tipo_anexo (tipo_anx_nome, tipo_anx_descricao, tipo_anx_extensao, tipo_anx_icone) VALUES ( 'Video MPEG', 'Arquivo de video formato MPEG', 'MPEG', 'ext_mpeg.gif');
INSERT INTO tipo_anexo (tipo_anx_nome, tipo_anx_descricao, tipo_anx_extensao, tipo_anx_icone) VALUES ( 'Video MOV', 'Arquivo de video formato MOV (QuikTime)', 'MOV', 'ext_mov.gif');
INSERT INTO tipo_anexo (tipo_anx_nome, tipo_anx_descricao, tipo_anx_extensao, tipo_anx_icone) VALUES ( 'Audio WAV', 'Arquivo audio formato WAV', 'WAV', 'ext_wav.gif');
INSERT INTO tipo_anexo (tipo_anx_nome, tipo_anx_descricao, tipo_anx_extensao, tipo_anx_icone) VALUES ( 'Audio MP3', 'Arquivo de audio formato MP3', 'MP3', 'ext_mp3.gif');
INSERT INTO tipo_anexo (tipo_anx_nome, tipo_anx_descricao, tipo_anx_extensao, tipo_anx_icone) VALUES ( 'Texto DOC', 'Arquivo de texto do Word', 'DOC', 'ext_doc.gif');
INSERT INTO tipo_anexo (tipo_anx_nome, tipo_anx_descricao, tipo_anx_extensao, tipo_anx_icone) VALUES ( 'Texto PDF', 'Arquivo de texto em formato PDF', 'PDF', 'ext_pdf.gif');
INSERT INTO tipo_anexo (tipo_anx_nome, tipo_anx_descricao, tipo_anx_extensao, tipo_anx_icone) VALUES ( 'Planilha XLS', 'Planilha do Excel', 'XLS', 'ext_xls.gif');
INSERT INTO tipo_anexo (tipo_anx_nome, tipo_anx_descricao, tipo_anx_extensao, tipo_anx_icone) VALUES ( 'Compactado ZIP', 'Arquivo Compactado em Winxip', 'ZIP', 'ext_zip.gif');
INSERT INTO tipo_anexo (tipo_anx_nome, tipo_anx_descricao, tipo_anx_extensao, tipo_anx_icone) VALUES ( 'Apresentao PPS', 'Apresentao de slides', 'PPS', 'ext_pps.gif');
INSERT INTO tipo_anexo (tipo_anx_nome, tipo_anx_descricao, tipo_anx_extensao, tipo_anx_icone) VALUES ( 'Executavel EXE', 'Arquivo Executavel', 'EXE', 'ext_exe.gif');

INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Acre','AC');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Alagoas','AL');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Amapa','AP');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Amazonas','AM');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Bahia','BA');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Ceara','CE');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Distrito Federal','DF');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Espirito Santo','ES');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Goias','GO');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Maranhao','MA');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Mato Grosso','MT');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Mato Grosso do Sul','MS');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Minas Gerais','MG');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Para','PA');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Paraiba','PB');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Parana','PR');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Pernambuco','PE');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Piaui','PI');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Rio de Janeiro','RJ');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Rio Grande do Norte','RN');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Rio Grande do Sul','RS');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Rondonia','RO');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Roraima','RR');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Santa Catarina','SC');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Sao Paulo','SP');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Sergipe','SE');
INSERT INTO end_uf (end_uf_nome,end_uf_sigla) VALUES ('Tocantins','TO');



INSERT INTO nwsl_usuario (nwsl_usr_nome, nwsl_usr_email, nwsl_usr_dt_cadastro) VALUES ('saulo spam gmail', 'saulo.spam@gmail.com', '2009-05-16 10:43:44');
INSERT INTO nwsl_usuario (nwsl_usr_nome, nwsl_usr_email, nwsl_usr_dt_cadastro) VALUES ('saulo gmail', 'sauloandrade@gmail.com', '2009-05-16 10:43:44');
INSERT INTO nwsl_usuario (nwsl_usr_nome, nwsl_usr_email, nwsl_usr_dt_cadastro) VALUES ('saulo yahoo', 'sauloandrade@yahoo.com', '2009-05-16 10:43:44');

INSERT INTO  nwsl_template(nwsl_temp_nome,nwsl_temp_path) VALUES('Template 1', 'D:/Documents and Settings/up23/Meus documentos/freela/workspace/php/aduneb/www/nucleo/templates/envio_email.html');
INSERT INTO  nwsl_template(nwsl_temp_nome,nwsl_temp_path) VALUES('Template 2', 'D:/Documents and Settings/up23/Meus documentos/freela/workspace/php/aduneb/www/nucleo/templates/envio_email.html');

INSERT INTO menu_link (menu_link_nome, menu_link_descricao, menu_link_ordem, menu_link_pai_fk) VALUES ('Raiz', 'Raiz dos menus', 0, NULL);
INSERT INTO menu_link (menu_link_nome, menu_link_descricao, menu_link_url,menu_link_target, menu_link_ordem, menu_link_pai_fk) VALUES ('Home', 'Pagina inicial', '/','_top',1,1);
  

 
INSERT INTO enq_categoria (enq_cat_nome, enq_cat_descricao) VALUES ('Capa', 'Enquete da capa do site');
-- INSERT INTO enq_enquete (enq_enq_pergunta, enq_enq_tp_resposta, enq_enq_resultado_porcentagem, enq_enq_resultado_absoluto, enq_enq_duracao_voto, enq_enq_dt_criacao, enq_enq_dt_inicio, enq_enq_dt_fim, enq_cat_fk, adm_usr_fk ) VALUES ( 'Qual a sua avaliao sobre a poltica para educao  do Governo Wagner?', 'U', 'A', 'A', 1, '2009-05-16 21:46:57', '2009-05-16 21:46:00', '2009-12-15 21:46:00', 1, 1);
-- INSERT INTO enq_resposta (enq_resp_resposta,enq_enq_fk) VALUES ('tima', 2);
-- INSERT INTO enq_voto (enq_voto_ip, enq_voto_dt_votacao, enq_resp_fk) VALUES ( '189.105.164.12', '2009-05-20 02:30:55', 8);

  
-- INSERT INTO news_noticia (news_not_titulo, news_not_target, news_not_destaque, news_not_corpo, news_not_chamada, news_not_link, news_not_origem, news_not_autor, news_not_dt_criacao, news_not_dt_inicio, news_not_dt_fim, news_cat_fk, adm_usr_fk, idi_idioma_fk, news_not_status) VALUES ('Links teis', '_blank', 'A', 'Teste de conteudo', 'destaque', '', 'ADUNEB', 'Gabriel Ferreira Jourdan', '2009-06-27 12:44:48', '2009-05-12 21:24:00', '2014-05-12 21:24:00', 8, 4, 1, 'A');
-- INSERT INTO news_anexo (news_anx_titulo, news_anx_descricao, news_anx_dt_cadastro, news_anx_path, news_anx_credito, tipo_anx_fk, news_not_fk) VALUES ( 'Prestao de contas - 09/2005 - Manuteno', '09/2005', '2009-06-21 18:31:32', '00000003_20090515225857_RAZAO_09 2005_CONTADEMANUTENCAO.xls', 'ADUNEB', 8, 3);
-- INSERT INTO news_imagem (news_img_titulo, news_img_destaque, news_img_descricao, news_img_dt_cadastro, news_img_path1, news_img_path2, news_img_credito, news_not_fk) VALUES ( 'Assemblia do movimento docente 17.12.2003', 'I', 'Assemblia do movimento docente 17.12.2003', '2009-05-14 20:26:13', '00000021_1_20090514202613_dezembro 042.jpg', '00000021_2_20090514202613_dezembro 042.jpg', 'por grevistas', 21);


-- INSERT INTO nwsl_envio( nwsl_env_assunto, nwsl_env_path, nwsl_env_corpo text, nwsl_env_status, nwsl_env_dt_cadastro, nwsl_env_dt_envio) VALUES ('ADUNEB-Mail 2009 - Edio 227', '20090517162255_foto_227.jpg', 'Teste de conteudo de envio de email', 'E', '2009-05-16 11:00:18', '2009-05-16 15:48:12');
