$(document).ready(function() {
	setMyBg();
	if($(window).width()<1200){return;}
	var docHeight = $(window).height();
	var footerHeight = $('#footer').height();
	var footerTop = $('#footer').position().top + footerHeight;
	if (footerTop < docHeight) {
		$('#mybg1').css('height', -12+(docHeight - footerHeight - $('#header').height()) + 'px');
		$('#mybg2').css('height', -12+(docHeight - footerHeight - $('#header').height()) + 'px');
	}
	if ($('#mybg1').height()<$('#mybg2').height()){
		$('#mybg1').css('height', ($('#mybg2').height() + 13) + 'px');
	}
	else{
		$('#mybg2').css('height', ($('#mybg1').height() + 13) + 'px');
	}
});

function setMyBg(){
	var mybg1style = getComputedStyle(document.getElementById('mybg1'));
	var mybg2style = getComputedStyle(document.getElementById('mybg2'));
	$('#mybg2').css('background-position','0 0, 0 0, 0 0,' + (-$('#mybg2').offset().left) + 'px ' + (-$('#mybg2').offset().top) + 'px');
	$('#mybg1').css('background-position','0 0, 0 0, 0 0,' + (-$('#mybg1').offset().left) + 'px ' + (-$('#mybg1').offset().top) + 'px');
	$('#mybg2').css('-ms-background-position',(-$('#mybg2').offset().left) + 'px ' + (-$('#mybg2').offset().top) + 'px');
	$('#mybg1').css('-ms-background-position',(-$('#mybg1').offset().left) + 'px ' + (-$('#mybg1').offset().top) + 'px');
}

function radioChange(idon, idoff1, idoff2){
	$('#' + idon).addClass("checked shadow-top");
	$('#' + idoff1).removeClass();
	$('#' + idoff2).removeClass();
}

function changeCheckBox(id){
	if($('#'+id)["0"].checked){
		$('#'+id+'l').addClass("checked shadow-top");
	}
	else{
		$('#'+id+'l').removeClass("checked shadow-top");	
	}
}

//____________________________________________AVA_______________________________________________

$(function(){
    var wrapper = $( ".file_upload" ),
        inp = wrapper.find( "input" ),
        btn = wrapper.find( ".button" ),
        lbl = wrapper.find( "mark" );

    inp.focus(function(){
        wrapper.addClass( "focus" );
    }).blur(function(){
        wrapper.removeClass( "focus" );
    });

    var file_api = ( window.File && window.FileReader && window.FileList && window.Blob ) ? true : false;

    inp.change(function(){
        var file_name;
        if( file_api && inp[ 0 ].files[ 0 ] )
            file_name = inp[ 0 ].files[ 0 ].name;
        else
            file_name = inp.val().replace( "C:\\fakepath\\", '' );

        if( ! file_name.length )
            return;

        if( lbl.is( ":visible" ) ){
            lbl.text( file_name );
            btn.text( "Выбрать" );
        }else
            btn.text( file_name );
    }).change();

});
$( window ).resize(function(){
    $( ".file_upload input" ).triggerHandler( "change" );
});

//___________________________________VALIDATION_____________________________________________

// $.validator.setDefaults( {
// 	submitHandler: function () {
// 		validationFunc();
// 	}
// } );

// $( document ).ready( function () {
// 	$( "#regForm" ).validate( {
// 		rules: {
// 			firstname: "required",
// 			lastname: "required",
// 			nickname: {
// 				required: true,
// 				minlength: 6
// 			},
// 			password: {
// 				required: true,
// 				minlength: 8
// 			},
// 			confirm_password: {
// 				required: true,
// 				minlength: 8,
// 				equalTo: "#password"
// 			},
// 			email: {
// 				required: true,
// 				email: true
// 			},
// 			city: "required",
// 			agree: "required"
// 		},
// 		messages: {
// 			firstname: "Please enter your first name",
// 			lastname: "Please enter your last name",
// 			nickname: {
// 				required: "Please enter your nickname",
// 				minlength: "Your nickname must consist of at least {0} characters"
// 			},
// 			password: {
// 				required: "Please provide a password",
// 				minlength: "Your password must be at least {0} characters long"
// 			},
// 			confirm_password: {
// 				required: "Please provide a password",
// 				minlength: "Your password must be at least {0} characters long",
// 				equalTo: "Please enter the same password as above"
// 			},
// 			email: "Please enter a valid email address",
// 			city: "Please enter your city",
// 			agree: "Please accept our policy"
// 		},
// 		errorElement: "em",
// 		errorPlacement: function ( error, element ) {
// 			error.addClass( "help-block" );
// 			if((element.prop("name")!=='bDay')||(element.prop("name")!=='bYear')||(element.prop("name")!=='bMonth')){
// 				//alert(element.prop("name"));
// 				element.parents( ".row" ).addClass( "has-feedback" );

// 				if ( element.prop( "type" ) === "checkbox" ) 
// 					error.insertAfter( element.parents( "label" ) );
// 				else 
// 					error.insertAfter( element );			
				
// 				$( "<span class='glyphicon glyphicon-remove form-control-feedback'/>" ).insertAfter( $( element ) );
// 			}
// 		},
// 		success: function ( label, element ) {
// 			if((element.prop("name")!=='bDay')||(element.prop("name")!=='bYear')||(element.prop("name")!=='bMonth')) {
// 				if ( (!$( element ).next( "span" )[ 0 ]) ) {
// 					$( "<span class='glyphicon glyphicon-ok form-control-feedback'/>" ).insertAfter( $( element ) );
// 				}
// 			}
// 		},
// 		highlight: function ( element, errorClass, validClass ) {
// 			if($(element).prop("type")==="number" || $(element).prop("type")==="radio" || $(element).prop("type")==="checkbox") 
// 				$( element ).parent("*").parent( ".row" ).addClass( "has-error" ).removeClass( "has-success" );
// 			else 
// 			 	$( element ).parent( ".row" ).addClass( "has-error" ).removeClass( "has-success" );
// 			$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
// 		},
// 		unhighlight: function ( element, errorClass, validClass ) {
// 			if($(element).prop("type")==="number" || $(element).prop("type")==="radio"){
// 				$( element ).parent("*").parent( ".row" ).addClass( "has-success" ).removeClass( "has-error" );
// 			} else {
// 				$( element ).parent( ".row" ).addClass( "has-success" ).removeClass( "has-error" );
// 			}
// 			$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
// 		}
// 	} );//validate
// } );//ready

// function validationFunc(){
// 	//form.submit();
// }