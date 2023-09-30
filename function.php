<?php


function myfilter() {





$meta_query=array();





$filter_form=$_GET['filter_form'];





if ($_GET['main-category']) {



    $main_category=$_GET['main-category'];



    $meta_query[0]=array(



            'key' => 'categorie',



            'value' => $main_category,



            'compare' => '='



        );



    }







    if ($_GET['merk']) {



    $merk=$_GET['merk'];



    $meta_query[1]=array(



            'key' => 'merk',



            'value' => $merk,



            'compare' => '='



        );



    }











    if ( ($_GET['prijsmin']) &&  ($_GET['prijsmax']) ) {



        $prijsmin=$_GET['prijsmin'];



        $prijsmax=$_GET['prijsmax'];



        $meta_query[2]=array(



            'key' => 'prijsexcl',



            'type'    => 'numeric',



            'value' => array($prijsmin,$prijsmax) ,



            'compare' => 'BETWEEN'



        );



        



    }



    elseif ($_GET['prijsmin']) {







    $prijsmin=$_GET['prijsmin'];



    $meta_query[2]=array(



            'key' => 'prijsexcl',



            'value' => $prijsmin,



            'compare' => '>='



        );



    }



    elseif ($_GET['prijsmax']) {



    $prijsmax=$_GET['prijsmax'];



    $meta_query[2]=array(



            'key' => 'prijsexcl',



            'value' => $prijsmax,



            'compare' => '<='



        );







    }











    if ( ($_GET['draaiurenMin']) &&  ($_GET['draaiurenMax']) ) {



        $draaiurenMin=$_GET['draaiurenMin'];



        $draaiurenMax=$_GET['draaiurenMax'];



        $meta_query[3]=array(



            'key' => 'draaiuren',



            'type'    => 'numeric',



            'value' => array($draaiurenMin,$draaiurenMax) ,



            'compare' => 'BETWEEN'



        );



        



    }



    elseif ($_GET['draaiurenMin']) {







    $draaiurenMin=$_GET['draaiurenMin'];



    $meta_query[3]=array(



            'key' => 'draaiuren',



            'value' => $draaiurenMin,



            'compare' => '>='



        );



    }



    elseif ($_GET['draaiurenMax']) {



    $draaiurenMax=$_GET['draaiurenMax'];



    $meta_query[3]=array(



            'key' => 'draaiuren',



            'value' => $draaiurenMax,



            'compare' => '<='



        );







    }















    if ( ($_GET['bouwjaarMin']) &&  ($_GET['bouwjaarMax']) ) {







        $bouwjaarMin=$_GET['bouwjaarMin'];



        $bouwjaarMax=$_GET['bouwjaarMax'];



        $meta_query[4]=array(



            'key' => 'bouwjaar',



            'type'    => 'string',



            'value' => array($bouwjaarMin,$bouwjaarMax) ,



            'compare' => 'BETWEEN'



        );



        



    }



    elseif ($_GET['bouwjaarMin']) {







    $bouwjaarMin=$_GET['bouwjaarMin'];



    $meta_query[4]=array(



            'key' => 'bouwjaar',



            'type'    => 'string',



            'value' => $bouwjaarMin,



            'compare' => '>='



        );



    }



    elseif ($_GET['bouwjaarMax']) {







    $bouwjaarMax=$_GET['bouwjaarMax'];



    $meta_query[4]=array(



            'key' => 'bouwjaar',



            'type'    => 'string',



            'value' => $bouwjaarMax,



            'compare' => '=<'







        );







    }





    if ($_GET['contact_filiaal']) {



    $contact_filiaal=$_GET['contact_filiaal'];







    $meta_query[5]=array(



            'key' => 'contact_filiaal',



            'value' => $contact_filiaal,



            'compare' => '='



        );







    }







    if ($_GET['post-filters']) {



    $post_filters=$_GET['post-filters'];



    foreach ($post_filters as $key => $post_filters_value) {







if ($post_filters_value=='today') {



    $meta_query[6]=array(



            'key' => 'lastChangeDate',



            'value' => date("Y-m-d"),



            'type'    => 'DATE',



            'compare' => '=',



        );



}







elseif ($post_filters_value=='yesterday') {



    $yesterday = date('Y-m-d', strtotime('-1 day'));



    $meta_query[6]=array(



            'key' => 'lastChangeDate',



            'value' => $yesterday,



            'type'    => 'DATE',



            'compare' => '=',



        );



}







elseif ($post_filters_value=='one-week') {







    $meta_query[6]=array(



            'key' => 'lastChangeDate',



            'value' => array(date('Y-m-d', strtotime('-6 days')), date('Y-m-d')),



            'type'    => 'DATE',



            'compare' => 'BETWEEN'



        );



}







elseif ($post_filters_value=='all') {



    



    $meta_query[6]=array(



            'key' => 'lastChangeDate',



            'value' => array( '1900-01-01', date('Y-m-d') ),



            'type'    => 'DATE',



            'compare' => 'BETWEEN'



        );







}







}



    }



    



if ($_GET['search']) {







    $search=$_GET['search'];



    



    $meta_query[7]=array(



        'relation' => 'OR',



        array(



            'key'       => 'art_code',



            'value'     => $search,



            'compare'   => '=',



        ),



        array(



            'key'       => 'naam',



            'value'     => $search,



            'compare'   => '=',



        ),



         array(



            'key'       => 'merk',



            'value'     => $search,



            'compare'   => '=',



        ),



     



    );







      



    }







global $wpdb;







if (($_GET['main-category'] == "") && ($_GET['merk'] == "")  && ($_GET['prijsmin'] == "")  && ($_GET['prijsmax'] == "")  && ($_GET['draaiurenMin'] == "")  && ($_GET['draaiurenMax'] == "")  && ($_GET['bouwjaarMin'] == "") && ($_GET['bouwjaarMax'] == "") && ($_GET['contact_filiaal'] == "") && ($_GET['search'] == "")) {







    $args = array(



   'posts_per_page' => 4,



    'post_type' => 'machine',



    'post_status' => 'publish',



    'meta_key' => 'top',



    'meta_value' => 'ja', 



    'orderby' => 'title',



    'order' => 'ASC',



    'meta_query' => array(



    'relation' => 'AND',



        $meta_query



    )



);







    



}else{







    $args = array(



   'posts_per_page' => -1,



    'post_type' => 'machine',



    'post_status' => 'publish', 



    'orderby' => 'title',



    'order' => 'ASC',



    'meta_query' => array(



    'relation' => 'AND',



        $meta_query



    )



);







}



















    $the_query = new WP_Query($args);







    $total = $the_query->found_posts;



 







if ( $the_query->have_posts() ) {



  $html="";



    while ( $the_query->have_posts() ) {



        $the_query->the_post();



        



        $post_id=get_the_ID();



       



        $art_code = get_post_meta( $post_id, 'art_code', true );  



       



         $prijsexcl = get_post_meta( $post_id, 'prijsexcl', true );



          if ($prijsexcl) {



            $prijsexclnew="<br>Prijis:". $prijsexcl;



        }



        $bouwjaar = get_post_meta( $post_id, 'bouwjaar', true );



         if ($bouwjaar) {



            $bouwjaarnew="<br>Bouwjaar:". $bouwjaar;



        }



        $draaiuren = get_post_meta( $post_id, 'draaiuren', true );



         if ($draaiuren) {



            $draaiurennew="<br>Draaiuren:". $draaiuren;



        }



          $beschrijving = get_post_meta( $post_id, 'beschrijving', true );



           if (empty($beschrijving)) {



            $beschrijvingnew="<br>Beschrijving:". $beschrijving;



        };



        $top = get_post_meta( $post_id, 'top', true );



           if ($top) {



                 $top = get_post_meta( $post_id, 'top', true );



        };



       



if ($top=="Ja") {



    $topnew='<div class="top_occasions"><h2 class="top">Top</h2><p class="occasions">Occasions</p></div>';



   



}











        $directoryurl= site_url().'/IMG/'.$art_code; 







        $full_img= $directoryurl.'/'.$art_code.'_'.'001.jpg';



        if (!is_file($full_img)) {



            



            $full_img=site_url().'/wp-content/uploads/2023/08/image1.png';  



        }



        $html.='<div class="blog">';



        $html.='<div class="blog-img">';



        $html.=$topnew;



        $html.='<img src="'.$full_img.'">';



        $html.='<h2 class="blog-title">'.get_the_title().'</h2>';



        $html.='</div>';



        $html.='<div class="grey">';



        $html.='<div class="blog-content">';



        $html.='<p class="blog-desc">'."Artcode: $art_code".''."$prijsexclnew".''." $bouwjaarnew".''."$draaiurennew".''."$beschrijvingnew".'</p>' ; 



        



        $html.='<div class="blog-details">';



        $html.='<button id="fancyButton"><a href="'.site_url().'/inner-page/?product_id='.$post_id.'">MORE INFO</a><span class="right-arrow">&#129170;</span></button>';



        $html.='</div>';



        $html.='</div>';



        $html.='</div>';



        $html.='</div>';







        



wp_reset_postdata();



                       } 



}else{







    $html="No Post Found!";



}











if (($_GET['main-category']!="") && ($_GET['main-subcategory']!="")) {



    $parent_category_name1=$_GET['main-subcategory'];



  



$parent_category1 = get_term_by('name', $parent_category_name1, 'category');







if ($parent_category1) {



    $parent_category_id1 = $parent_category1->term_id;



    $subcategories1 = get_categories(array(



        'child_of' => $parent_category_id1,



        'hide_empty' => false,



    ));



    if ($subcategories1) {





     $sub_select1.='<option value="">--- Maak een keuze ---</option>';

 

    foreach ($subcategories1 as $subcategory1) {



        // Access subcategory properties



        $subcategory_name1 = $subcategory1->name;



        $subcategory_id1 = $subcategory1->term_id;







        $sub_select1.='<option value="'.$subcategory_name1.'">'.$subcategory_name1.'</option>';



                                                                   



         



    }

 $sub_select1.='</select>';

 $return_arr[] = array("sub_select1" => $sub_select1,"html" => $html ,"filter_form" => $filter_form ,"total" => $total);



}else{







     $return_arr[] = array("html" => $html,"filter_form" => $filter_form,"total" => $total);



}







} 



else {



    echo 'Parent category not found.';



    $return_arr[] = array("html" => $html,"filter_form" => $filter_form,"total" => $total);



}























    }



if (($_GET['main-category']!="") && ($_GET['main-subcategory']=="")) {







        $parent_category_name=$_GET['main-category'];



    















$parent_category = get_term_by('name', $parent_category_name, 'category');







if ($parent_category) {



    $parent_category_id = $parent_category->term_id;



    $subcategories = get_categories(array(



        'child_of' => $parent_category_id,



        'hide_empty' => false,



    ));



    if ($subcategories) {



        



    



    // Loop through the subcategories



     $sub_select="";



     $sub_select.='<option value="">--- Maak een keuze ---</option>';

$sub_select.='<script>





 var list1 = $(".select3[multiple]").select2({



        width: "100%",



  maximumSelectionLength: 1,



      closeOnSelect: false



    }).on("select2:closing", function(e) {



      e.preventDefault();



    }).on("select2:closed", function(e) {



      list1.select2("open");



    });



    list1.select2("open");



</script>';

    foreach ($subcategories as $subcategory) {



        // Access subcategory properties



        $subcategory_name= $subcategory->name;



        $subcategory_id = $subcategory->term_id;







        $sub_select.='<option value="'.$subcategory_name.'">'.$subcategory_name.'</option>';



                                                                   



         



    }



 $return_arr[] = array("sub_select" => $sub_select,"html" => $html,"filter_form" => $filter_form,"total" => $total);



}else{







     $return_arr[] = array("html" => $html,"filter_form" => $filter_form,"total" => $total);



}







} 



else {



  



    $return_arr[] = array("html" => $html,"filter_form" => $filter_form,"total" => $total);



}







        



    }



if (($_GET['main-category']=="") && ($_GET['main-subcategory']=="")) {



  $return_arr[] = array("html" => $html,"filter_form" => $filter_form,"total" => $total);



}



















     echo json_encode($return_arr);















exit;















}







add_action( 'wp_ajax_nopriv_myfilter', 'myfilter' );



add_action( 'wp_ajax_myfilter', 'myfilter' );











add_action( 'wp_ajax_nopriv_update_merk', 'update_merk' );



add_action( 'wp_ajax_update_merk', 'update_merk' );

function update_merk() {



if ($_POST['main-category']!="") {





$meta_query=array();

    $main_category=$_POST['main-category'];



    $meta_query[0]=array(



            'key' => 'categorie',



            'value' => $main_category,



            'compare' => '='



        );







 $args = array(



   'posts_per_page' => -1,



    'post_type' => 'machine',



    'post_status' => 'publish', 



    'orderby' => 'title',



    'order' => 'ASC',



    'meta_query' => array(



    'relation' => 'AND',



        $meta_query



    )



);







 $the_query = new WP_Query($args);







    $total = $the_query->found_posts;



 



$merk_new=array();

$merk_new[]="<option value=''>Select</option>" ;



if ( $the_query->have_posts() ) {







    while ( $the_query->have_posts() ) {



   $the_query->the_post();



        



        $post_id=get_the_ID();



$merk_select = get_post_meta( $post_id, 'merk', true ); 

       

$merk_new[]="<option value='".$merk_select."'>".$merk_select."</option>" ;



}



 if (!empty($merk_new)) {

$uniqueWords=array_unique($merk_new);

$merk_option = implode(" ", $uniqueWords);

 $return_arr1[] = array("merk_option" => $merk_option ,"total" => $total);



}











}else{



    $merk_new=array();

$merk_new[]="<option value=''>Select</option>" ;



    $return_arr1[] = array("merk_option" => $merk_option ,"total" => 0);

}



    }

   







echo json_encode($return_arr1);















exit;





}


?>
