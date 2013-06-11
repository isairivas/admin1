$(document).ready(function (){
    var classOriginal ;
    $("#main-content #content table tbody tr").hover(function (){
        classOriginal = this.className;
        this.className = 'resaltado';
    },function (){
        this.className = classOriginal;
    });

    // iniciar tynimce
    tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        plugins : "emotions,spellchecker,advhr,insertdatetime,preview",

        // Theme options - button# indicated the row# only
        theme_advanced_buttons1 : ",bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect,formatselect",
        theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,|,code,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "insertdate,inserttime,|,spellchecker,advhr,,removeformat,|,sub,sup,|,charmap,emotions",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true
});


  
     
});// fin load page


/*
*
    var dias =['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
    var meses=[
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre'
    ];
    new DatePicker('.calendar', {
		pickerClass: 'datepicker_dashboard',
		allowEmpty: true,
		toggleElements: '.date_toggler',
         format: 'd/m/Y',
         inputOutputFormat:'d/m/Y',
         days:dias,
         months:meses
	}); 
 */