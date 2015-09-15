

/**
 * Fonction appelé sur la selection du type de contact du formulaire contact
 * Permet d'afficher le formulaire correspondant au type choisis
 *  
 */

function formChooser(){
    
   
    var typeCtc = $("#typeCtc").val();
  
    
    switch (typeCtc){
        
        
        case "1":
            
            $("#form_add_ent").show();
            $("#form_add_prs").hide();
            break;
            
        case "2":
           
           $("#form_add_ent").hide();
           $("#form_add_prs").show();
           break;
            
        case "0":
            
            $("#form_add_ent").hide();
            $("#form_add_prs").hide();  
            break;
        
    }
}
