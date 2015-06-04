

<?php
error_reporting(E_WARNING | E_ERROR);
$erreurs = array ();

function is_valid_email($mail) {
	return filter_var($mail, FILTER_VALIDATE_EMAIL); //Fonction toute faite pour valider les adresses mails, elle fait le café
	}


//FORM PROCESSING

	//Honeypot check. Ne pas oublier de display none le champs en CSS ;)

    $email = '';
    $prenom = '';
    $nom = '';
    $msg = '';

	if ($_POST['honeypot'] != ''){
				die ('meurs robot');

			}


if(count($_POST)>0){
	
	//Nettoyage
	$email = trim( strip_tags ($_POST['mail']));
	$prenom = trim( strip_tags ($_POST['prenom']));
	$nom = trim( strip_tags ($_POST['nom']));
	$msg = trim( strip_tags ($_POST['msg']));
		
		if(!is_valid_email($email)) //Le ! indique le contraire, donc la on dit si l'adresse n'EST PAS VALIDE alors
		{
		$erreurs['email'] = "! le mail n'est pas valide";
		}

		if($prenom=="")
		{
		$erreurs['prenom'] = "! vous n'avez pas rempli le champ prenom";
		}

		if($nom=="")
		{
		$erreurs['nom'] = "! vous n'avez pas rempli le champ nom";
		}
		
		if($msg=="")
		{
		$erreurs['msg'] = "! vous n'avez pas rempli le champ message";
		}
		
			
			if(count($erreurs)==0){
                ?>
                <p class="revelation">
			<?php
            echo 'Merci, vous recevrez bientot les revelations ancestrales';
            ?>
        </p>
        <?php
			$sujet = 'message du formulaire des dieux';
			$result = mail ('hubert.maxime.emilien@gmail.com',$sujet,$msg);
			//Si j'upload sur OVH ca devrait marcher
			}
		
	}


?>
		<body>

			<?php

			include('header.php');

			?>
		
        <form method="POST">
        
        	<ul>
                <li>
                    <label for="mail">Ton mail<span>*</span></label>
                    <?php
                    echo "<input id=\"mail\" type=\"text\" name=\"mail\" value=\"$email\" >"
                    ?>
                    <div class="errordisplay">
                    <?php
                    if ($erreurs['email'] != ''){
                    	echo ($erreurs['email']);
                    }
                    

                    ?>
                    </div>
                </li>
            
                <li>
                    <label for="prenom">Ton prenom</label>
                    <?php
                    echo "<input id=\"prenom\" type=\"text\" name=\"prenom\" value=\"$prenom\" >"
                    ?>
                    <div class="errordisplay">
                    <?php
                    if ($erreurs['prenom'] != ''){
                    	echo ($erreurs['prenom']);
                    }

                    ?>
                </div>
                </li>
                
                <li>  
                    <label for="nom">Ton nom</label>
                    <?php
                    echo "<input id=\"nom\" type=\"text\" name=\"nom\" value=\"$nom\" >"
                    ?>
                    <div class="errordisplay">
                    <?php
                    if ($erreurs['nom'] != ''){
                    	echo ($erreurs['nom']);
                    }

                    ?>
                </div>
                </li>

                <li>
                    <label for="honeypot">Ne pas remplir !</label>
                    <input id="honeypot" type="text" name="honeypot" >
                </li>
                
                <li>  
                    <label for="msg">Ton message<span>*</span></label>

                    <textarea id="msg" type="text" name="msg" ><?php echo $msg; ?></textarea>

                    <div class="errordisplay">
                    <?php
                    if ($erreurs['msg'] != ''){
                    	echo ($erreurs['msg']);
                    }

                    ?>
                </div>
                </li>
               
            </ul>
                 
            <input id="envoi" type="submit" name='soumission' value="confirmer">
    	
    	</form>
        
        <?php
        include('footer.php');
		?>
        
        
        </body>
</html>
