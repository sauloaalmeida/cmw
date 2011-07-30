DROP PROCEDURE IF EXISTS getCategoriasPai;
DELIMITER $$
CREATE PROCEDURE getCategoriasPai(catId INT)
BEGIN

   DECLARE l_cat_id INT;
   DECLARE l_cat_nome VARCHAR(50);
   DECLARE l_cat_pai INT;
   DECLARE l_ordem_insert INT DEFAULT 1;

   IF (catId IS NOT NULL) THEN

      SET l_cat_pai = catId;

      
      DROP TEMPORARY TABLE IF EXISTS hierarquia_categoria_temp;
      CREATE TEMPORARY TABLE hierarquia_categoria_temp( t_news_cat_pk INT,
                                                        t_news_cat_nome VARCHAR(50),
                                                        t_news_cat_pai_fk INT,
                                                        t_ordem_insert INT);


          
          WHILE (l_cat_pai IS NOT NULL) DO

              
              SELECT news_cat_pk,
                     news_cat_nome,
                     news_cat_pai_fk
              INTO l_cat_id,
                   l_cat_nome,
                   l_cat_pai
              FROM news_categoria
              WHERE news_cat_pk = l_cat_pai
			  ORDER BY news_cat_pk;

              
              IF (l_cat_nome <> 'Raiz') THEN

                  INSERT INTO hierarquia_categoria_temp(t_news_cat_pk,
                                t_news_cat_nome,
                                t_news_cat_pai_fk,
                                t_ordem_insert)
                                         VALUES(l_cat_id,
                                                l_cat_nome,
                                                l_cat_pai,
                                                l_ordem_insert);


                 
                 SET l_ordem_insert = l_ordem_insert + 1;

              END IF;

          END WHILE;

	      
	      SELECT t_news_cat_pk  as news_cat_pk,
                 t_news_cat_nome as news_cat_nome,
                 t_news_cat_pai_fk as news_cat_pai_fk,
                 t_ordem_insert as ordem_insert
          FROM hierarquia_categoria_temp
          ORDER BY t_ordem_insert desc;

          
          DROP TEMPORARY TABLE hierarquia_categoria_temp;

      END IF;

END
$$



DROP PROCEDURE IF EXISTS getMenusPai $$
CREATE PROCEDURE getMenusPai(menuId INT)
BEGIN

   DECLARE l_menu_id INT;
   DECLARE l_menu_nome VARCHAR(50);
   DECLARE l_menu_pai INT;
   DECLARE l_menu_descricao VARCHAR(255);
   DECLARE l_menu_path VARCHAR(255);
   DECLARE l_menu_url VARCHAR(255);
   DECLARE l_menu_target VARCHAR(30);
   DECLARE l_menu_ordem INT;

   IF (menuId IS NOT NULL) THEN

      SET l_menu_pai = menuId;

      
      DROP TEMPORARY TABLE IF EXISTS hierarquia_menu_temp;
      CREATE TEMPORARY TABLE hierarquia_menu_temp(t_menu_link_pk INT,
						t_menu_link_nome VARCHAR(100),
						t_menu_link_descricao VARCHAR(255),
						t_menu_link_path VARCHAR(255),
						t_menu_link_url VARCHAR(255),
						t_menu_link_target VARCHAR(30),
						t_menu_link_ordem INT,
						t_menu_link_pai_fk INT);


          
          
          WHILE (l_menu_pai IS NOT NULL) DO

              
              SELECT menu_link_pk,
                     menu_link_nome,
		     menu_link_descricao,
          	     menu_link_path,
          	     menu_link_url,
          	     menu_link_target,
        	     menu_link_ordem,
                     menu_link_pai_fk
              INTO l_menu_id,
                   l_menu_nome,
        	   l_menu_descricao,
        	   l_menu_path,
        	   l_menu_url,
        	   l_menu_target,
        	   l_menu_ordem,
                   l_menu_pai
              FROM menu_link
              WHERE menu_link_pk = l_menu_pai
      	      ORDER BY menu_link_ordem;

              
              IF (l_menu_nome <> 'Raiz') THEN

                  INSERT INTO hierarquia_menu_temp(t_menu_link_pk,
						 t_menu_link_nome,
						 t_menu_link_descricao,
						 t_menu_link_path,
						 t_menu_link_url,
						 t_menu_link_target,
						 t_menu_link_ordem,
						 t_menu_link_pai_fk)
                                         VALUES(l_menu_id,
					   l_menu_nome,
					   l_menu_descricao,
					   l_menu_path,
					   l_menu_url,
					   l_menu_target,
					   l_menu_ordem,
					   l_menu_pai);

              END IF;

          END WHILE;

	      
	      SELECT t_menu_link_pk as menu_link_pk,
				 t_menu_link_nome as menu_link_nome,
				 t_menu_link_descricao as menu_link_descricao,
				 t_menu_link_path as menu_link_path,
				 t_menu_link_url as menu_link_url,
				 t_menu_link_target as menu_link_target,
				 t_menu_link_ordem as menu_link_ordem,
				 t_menu_link_pai_fk as menu_link_pai_fk
          FROM hierarquia_menu_temp
          ORDER BY t_menu_link_ordem;

          
          DROP TEMPORARY TABLE hierarquia_menu_temp;

      END IF;

END
$$



DROP PROCEDURE IF EXISTS  getMenusFilhos $$
CREATE PROCEDURE getMenusFilhos(menuPaiId INT, nivel INT)
BEGIN

   DECLARE l_menu_id INT;
   DECLARE l_menu_pai_id INT;
   DECLARE l_menu_nome VARCHAR(50);
   DECLARE l_menu_descricao VARCHAR(255);
   DECLARE l_menu_path VARCHAR(255);
   DECLARE l_menu_url VARCHAR(255);
   DECLARE l_menu_target VARCHAR(30);
   DECLARE l_menu_ordem INT;
   DECLARE l_menu_nivel INT;
   DECLARE l_menu_existe_filho INT;
   DECLARE done INT DEFAULT 0;
   DECLARE cursorMenu CURSOR FOR
			SELECT m.menu_link_pk,
					m.menu_link_nome,
					m.menu_link_descricao,
					m.menu_link_url,
					m.menu_link_target,
					m.menu_link_path,
					m.menu_link_ordem,
					m.menu_link_pai_fk,
          (SELECT IF ((SELECT EXISTS(select m2.menu_link_pk from menu_link m2 where m2.menu_link_pai_fk=m.menu_link_pk) ),1,0)) menu_link_existe_filho
			FROM menu_link m
			WHERE m.menu_link_pai_fk= menuPaiId
			ORDER BY m.menu_link_ordem;
   DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

   SET @@session.max_sp_recursion_depth= 255;

   IF ((menuPaiId IS NOT NULL) AND ( SELECT EXISTS(select menu_link_pk from menu_link where menu_link_pai_fk=menuPaiId)) ) THEN

      SET l_menu_nivel = nivel+1;

      OPEN cursorMenu;
      REPEAT
        FETCH cursorMenu INTO l_menu_id, l_menu_nome,l_menu_descricao,l_menu_url,l_menu_target,l_menu_path,l_menu_ordem,l_menu_pai_id, l_menu_existe_filho;
        IF NOT done THEN

             INSERT INTO arvore_menu_temp(
                 t_menu_link_pk,
		 t_menu_link_nome,
  		 t_menu_link_descricao,
	  	 t_menu_link_path,
		 t_menu_link_url,
		 t_menu_link_target,
		 t_menu_link_ordem,
		 t_menu_link_nivel,
		 t_menu_link_pai_fk,
     t_menu_link_existe_filho)
             VALUES(l_menu_id,
 		   l_menu_nome,
 		   l_menu_descricao,
 		   l_menu_path,
 		   l_menu_url,
 		   l_menu_target,
 		   l_menu_ordem,
 		   l_menu_nivel,
 		   l_menu_pai_id,
        l_menu_existe_filho);

             -- Verifica se tem filhos e chama a procedure recursivamente
             IF (l_menu_existe_filho) THEN
                CALL getMenusFilhos(l_menu_id,l_menu_nivel);
             END IF;

        END IF;
      UNTIL done END REPEAT;

      CLOSE cursorMenu;

      END IF;

END
$$



DROP PROCEDURE IF EXISTS getArvoreMenu $$
CREATE PROCEDURE getArvoreMenu()
BEGIN

   DECLARE l_menu_raiz INT;
   DECLARE l_nivel_inicial INT;

   SET @@session.max_sp_recursion_depth= 255;

   SELECT MIN(menu_link_pk) INTO l_menu_raiz FROM menu_link WHERE menu_link_pai_fk IS NULL;
   SET l_nivel_inicial = 0;

   IF (l_menu_raiz IS NOT NULL) THEN

      -- cria a estrutura de armazenamento temporario
      DROP TEMPORARY TABLE IF EXISTS arvore_menu_temp;
      CREATE TEMPORARY TABLE arvore_menu_temp
                          (t_menu_link_insert_id INT AUTO_INCREMENT,
			t_menu_link_pk INT,
			t_menu_link_nome VARCHAR(100),
			t_menu_link_descricao VARCHAR(255),
			t_menu_link_path VARCHAR(255),
			t_menu_link_url VARCHAR(255),
			t_menu_link_target VARCHAR(30),
			t_menu_link_ordem INT,
			t_menu_link_nivel INT,
			t_menu_link_pai_fk INT,
      t_menu_link_existe_filho INT,
      PRIMARY KEY  (t_menu_link_insert_id));

        CALL getMenusFilhos(l_menu_raiz,l_nivel_inicial);

	      -- retorna os registros da tabela temporaria
	      SELECT t_menu_link_pk as menu_link_pk,
				 t_menu_link_nome as menu_link_nome,
				 t_menu_link_descricao as menu_link_descricao,
				 t_menu_link_path as menu_link_path,
				 t_menu_link_url as menu_link_url,
				 t_menu_link_target as menu_link_target,
				 t_menu_link_ordem as menu_link_ordem,
				 t_menu_link_nivel as menu_link_nivel,
         t_menu_link_insert_id as menu_link_insert_id,
				 t_menu_link_pai_fk as menu_link_pai_fk,
				 t_menu_link_existe_filho as menu_link_existe_filho
        FROM arvore_menu_temp
	      ORDER BY menu_link_insert_id;

          -- limpa a tabela temporaria
          DROP TEMPORARY TABLE arvore_menu_temp;

      END IF;

END
$$