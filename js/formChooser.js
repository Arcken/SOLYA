

/**
 * Fonction appelé sur la selection du type de contact du formulaire contact
 * Permet d'afficher le formulaire correspondant au type choisis
 *  
 */

function formChooser(){
    
   
    var typeCtc = $("#typeCtc").val();
    
    console.log(typeCtc);
    
    switch (typeCtc){
        
         case "0":
             
            $("#add_ent").hide();
            $("#add_prs").hide();
            $("#add_adr").hide();
            $("#add_tel_mail").hide();
            $("#btn_zone").hide();
            
            break;
        
        case "1":
            
            $("#add_ent").show();
            $("#add_prs").hide();
            $("#add_adr").show();
            $("#add_tel_mail").show();
            $("#btn_zone").show();
            
            break;
            
        case "2":
           
           $("#add_ent").hide();
           $("#add_prs").show();
           $("#add_adr").show();
           $("#add_tel_mail").show();
           $("#btn_zone").show();
          
           break;
           
     
       
    }
}
