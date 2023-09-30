<?php

/* Template Name: machine */

?>
<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Archief Design Html</title>

    <link rel="stylesheet" type="text/css" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" media="mediatype and|not|only (expressions)" href="print.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css">

  </head>

  <body>

  

    <div class="container">

      <div class="categories-section">

        <ul>

          <li>Homepage <i class="fa fa-caret-right"></i>Occasion </li>

        </ul>

      </div>

      <div class="row">

        <div class="col-sm-3">

          <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

          <form action="" id="filter" method="get">

            <!--First Dropdown-->

            <div class="filter__group">



                <input type="hidden" name="main-category" id="main-category" value="">

                 <input type="hidden" name="mainsubcategory" id="mainsubcategory" value="">

                  <input type="hidden" name="mainsubcategory1" id="mainsubcategory1" value="">

              <h3 class="filter__group__title">Categorie</h3>

              <div class="filter__group__content">

                <div class="form__group">

                  <div class="country">

                 <?php

                 $categories = get_categories(

                    array(

                        'parent' => 0,

                        'hide_empty' => false,

                         'exclude' => get_cat_ID('Uncategorized')

                     )



                );



foreach ($categories as $category) {

    ?>

     <input type="checkbox"  id="<?php echo $category->term_id; ?>" value="<?php echo $category->name; ?>" onclick="showChildCategories('<?php echo $category->name; ?>','<?php echo $category->term_id; ?>')">

    <label for="<?php echo $category->name; ?>"><?php echo $category->name; ?></label><br>

    <div id="<?php echo $category->name; ?>-child-categories" style="display: none;">

    <?php

    $childCategories = get_categories(array('parent' => $category->term_id,'hide_empty' => false));

    foreach ($childCategories as $childCategory) {

        ?>

        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  id="<?php echo $childCategory->term_id; ?>" value="<?php echo $childCategory->name; ?>" class="subchild" onclick="showSubChildCategories('<?php echo $childCategory->name; ?>','<?php echo $childCategory->term_id; ?>')">

        <label for="<?php echo $childCategory->name; ?> "><?php echo $childCategory->name; ?></label><br>







        <div id="<?php echo $childCategory->name; ?>-sub-child-categories" style="display: none;">

         <?php

        // Loop for subchild categories

        $subChildCategories = get_categories(array('parent' => $childCategory->term_id,'hide_empty' => false));

        foreach ($subChildCategories as $subChildCategory) {

            ?>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  id="<?php echo $subChildCategory->term_id; ?>" value="<?php echo $subChildCategory->name; ?>" onclick="showSubSubChildCategories('<?php echo $subChildCategory->name; ?>','<?php echo $subChildCategory->term_id; ?>')"  class="subsubchild">

            <label for="<?php echo $subChildCategory->name; ?>"><?php echo $subChildCategory->name; ?></label><br>

            

         

        <?php

       

        }



    ?> </div>

        <?php 





    }

    ?>

    </div>

    <?php

}?>

                  </div>

                </div>

              </div>

            </div>

        

            <div class="filter__group" id="merk_new">

              <h3 class="filter__group__title">Merk</h3>

              <div class="filter__group__content">

                <div class="form__group"> 

                   <select name="merk" id="merk">

                    <option value="">Select</option>



                    <?php



                            global $wpdb;







                            $merk = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT meta_value  FROM wpnk_postmeta WHERE meta_key = %s", 'merk'));





foreach ($merk as $merk_val) {



$merk_select = $merk_val->meta_value;



                            ?> 



                   <option value="<?php echo $merk_select; ?>"><?php echo $merk_select; ?></option>

                    <?php

                   



}

                   ?>

                  </select>

                </div>

              </div>

            </div>

            <div class="filter__group" id="priceinput">

              <h3 class="filter__group__title">Prijs</h3>

              <div class="filter__group__content">

                <div class="form__group">

                  <label for="prijsmin" class="range-qty-euro">Van</label>

                  <input type="number" maxlength="4" name='prijsmin' value="" class="range-qty-new qty from" />

                </div>

                <div class="form__group data-collapsed">

                  <label for="prijsmax" class="range-qty-euro">Tot</label>

                  <input type="number" name='prijsmax' maxlength="4" value="" class="range-qty-new qty to" />

                </div>

              </div>

              <section>

                <input type="range" class="js-range-slider" value="" data-skin="round" data-type="double" data-min="0" data-max="200000" data-grid="false" />

              </section>

            </div>

            <div class="filter__group" id="darian">

              <h3 class="filter__group__title">Draaiuren</h3>

              <div class="filter__group__content">

                <div class="form__group">

                  <label for="draaiurenMin">Van</label>

                  <input type="number" maxlength="4" name='draaiurenMin' value="" class="range-qty-new qty from1" />

                </div>

                <div class="form__group data-collapsed">

                  <label for="draaiurenMax">Tot</label>

                  <input type="number" name='draaiurenMax' maxlength="4" value="" class="range-qty-new qty to1" />

                </div>

              </div>

              <section>

                <input type="range" class="js-range-slider1" value="" data-skin="round" data-type="double" data-min="0" data-max="20000" data-grid="false" />

              </section>

            </div>

            <div class="filter__group" id="Bouwjaar_new">

              <h3 class="filter__group__title">Bouwjaar</h3>

              <div class="filter__group__content">

                <div class="form__group">

                  

                  <select name="bouwjaarMin" id="bouwjaarMin" value="12">

                    <option value="">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">Van</font>

                      </font>

                    </option>

                    <option value="1980">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1980</font>

                      </font>

                    </option>

                    <option value="1983">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1983</font>

                      </font>

                    </option>

                    <option value="1985">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1985</font>

                      </font>

                    </option>

                    <option value="1986">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1986</font>

                      </font>

                    </option>

                    <option value="1987">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1987</font>

                      </font>

                    </option>

                    <option value="1989">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1989</font>

                      </font>

                    </option>

                    <option value="1990">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1990</font>

                      </font>

                    </option>

                    <option value="1991">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1991</font>

                      </font>

                    </option>

                    <option value="1992">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1992</font>

                      </font>

                    </option>

                    <option value="1993">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1993</font>

                      </font>

                    </option>

                    <option value="1994">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1994</font>

                      </font>

                    </option>

                    <option value="1995">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1995</font>

                      </font>

                    </option>

                    <option value="1996">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1996</font>

                      </font>

                    </option>

                    <option value="1997">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1997</font>

                      </font>

                    </option>

                    <option value="1998">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1998</font>

                      </font>

                    </option>

                    <option value="1999">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1999</font>

                      </font>

                    </option>

                    <option value="2000">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2000</font>

                      </font>

                    </option>

                    <option value="2001">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2001</font>

                      </font>

                    </option>

                    <option value="2002">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2002</font>

                      </font>

                    </option>

                    <option value="2003">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2003</font>

                      </font>

                    </option>

                    <option value="2004">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2004</font>

                      </font>

                    </option>

                    <option value="2005">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2005</font>

                      </font>

                    </option>

                    <option value="2006">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2006</font>

                      </font>

                    </option>

                    <option value="2007">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2007</font>

                      </font>

                    </option>

                    <option value="2008">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2008</font>

                      </font>

                    </option>

                    <option value="2009">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2009</font>

                      </font>

                    </option>

                    <option value="2010">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2010</font>

                      </font>

                    </option>

                    <option value="2011">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2011</font>

                      </font>

                    </option>

                    <option value="2012">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2012</font>

                      </font>

                    </option>

                    <option value="2013">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2013</font>

                      </font>

                    </option>

                    <option value="2014">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2014</font>

                      </font>

                    </option>

                    <option value="2015">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2015</font>

                      </font>

                    </option>

                    <option value="2016">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2016</font>

                      </font>

                    </option>

                    <option value="2017">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2017</font>

                      </font>

                    </option>

                    <option value="2018">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2018</font>

                      </font>

                    </option>

                    <option value="2019">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2019</font>

                      </font>

                    </option>

                    <option value="2020">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2020</font>

                      </font>

                    </option>

                    <option value="2021">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2021</font>

                      </font>

                    </option>

                    <option value="2022">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2022</font>

                      </font>

                    </option>

                    <option value="2023">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2023</font>

                      </font>

                    </option>

                  </select>

                </div>

                <div class="form__group">

                  

                  <select name="bouwjaarMax" id="bouwjaarMax">

                    <option value="">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">Tot</font>

                      </font>

                    </option>

                    <option value="2023">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2023</font>

                      </font>

                    </option>

                    <option value="2022">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2022</font>

                      </font>

                    </option>

                    <option value="2021">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2021</font>

                      </font>

                    </option>

                    <option value="2020">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2020</font>

                      </font>

                    </option>

                    <option value="2019">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2019</font>

                      </font>

                    </option>

                    <option value="2018">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2018</font>

                      </font>

                    </option>

                    <option value="2017">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2017</font>

                      </font>

                    </option>

                    <option value="2016">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2016</font>

                      </font>

                    </option>

                    <option value="2015">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2015</font>

                      </font>

                    </option>

                    <option value="2014">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2014</font>

                      </font>

                    </option>

                    <option value="2013">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2013</font>

                      </font>

                    </option>

                    <option value="2012">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2012</font>

                      </font>

                    </option>

                    <option value="2011">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2011</font>

                      </font>

                    </option>

                    <option value="2010">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2010</font>

                      </font>

                    </option>

                    <option value="2009">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2009</font>

                      </font>

                    </option>

                    <option value="2008">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2008</font>

                      </font>

                    </option>

                    <option value="2007">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2007</font>

                      </font>

                    </option>

                    <option value="2006">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2006</font>

                      </font>

                    </option>

                    <option value="2005">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2005</font>

                      </font>

                    </option>

                    <option value="2004">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2004</font>

                      </font>

                    </option>

                    <option value="2003">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2003</font>

                      </font>

                    </option>

                    <option value="2002">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2002</font>

                      </font>

                    </option>

                    <option value="2001">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2001</font>

                      </font>

                    </option>

                    <option value="2000">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2000</font>

                      </font>

                    </option>

                    <option value="1999">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1999</font>

                      </font>

                    </option>

                    <option value="1998">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1998</font>

                      </font>

                    </option>

                    <option value="1997">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1997</font>

                      </font>

                    </option>

                    <option value="1996">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1996</font>

                      </font>

                    </option>

                    <option value="1995">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1995</font>

                      </font>

                    </option>

                    <option value="1994">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1994</font>

                      </font>

                    </option>

                    <option value="1993">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1993</font>

                      </font>

                    </option>

                    <option value="1992">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1992</font>

                      </font>

                    </option>

                    <option value="1991">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1991</font>

                      </font>

                    </option>

                    <option value="1990">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1990</font>

                      </font>

                    </option>

                    <option value="1989">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1989</font>

                      </font>

                    </option>

                    <option value="1987">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1987</font>

                      </font>

                    </option>

                    <option value="1986">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1986</font>

                      </font>

                    </option>

                    <option value="1985">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1985</font>

                      </font>

                    </option>

                    <option value="1983">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1983</font>

                      </font>

                    </option>

                    <option value="1980">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1980</font>

                      </font>

                    </option>

                  </select>

                </div>

              </div>

            </div>

            <div class="form__group" id="Contact_filiaal_new">

              <h3 class="filter__group__title">Contact_filiaal</h3>

              <div class="filter__group__content"> <?php



global $wpdb;



$contact_filiaal = 'contact_filiaal';







$data = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key = %s", $contact_filiaal), ARRAY_N);







// $result = [];



foreach ($data as $array) {







}











?> <select name="contact_filiaal" id="contact_filiaal">

                  <option value="">--- Maak een keuze ---</option> <?php



foreach ($data as $array) {











    ?> <option value="

                                        <?php echo $array[0] ?>"> <?php echo $array[0] ?> </option> <?php



}



?>

                </select>

              </div>

            </div>

            <div class="filter__group">

              <h3 class="filter__group__title">Aangeboden sinds</h3>

              <div class="filter__group__content">

                <div class="form__group radio_content">

                  <label class="radio">

                    <input type="radio" class="radio__input" name="post-filters[date]" value="today" style="margin-right:10px;">Vandaag <span class="radio__indicator"></span>

                  </label>

                  <label class="radio">

                    <input type="radio" class="radio__input" name="post-filters[date]" value="yesterday" style="margin-right:10px;">Gisteren <span class="radio__indicator"></span>

                  </label>

                  <label class="radio">

                    <input type="radio" class="radio__input" name="post-filters[date]" value="one-week" style="margin-right:10px;">Een week <span class="radio__indicator"></span>

                  </label>

                  <label class="radio">

                    <input type="radio" class="radio__input"  name="post-filters[date]" value="all" style="margin-right:10px;">Altijd <span class="radio__indicator"></span>

                  </label>

                </div>

              </div>

            </div>

            <input type="hidden" name="search" value="" id="occ_search">

            <input type="hidden" name="action" value="myfilter">

          </form>

        </div>

        <div class="col-md-9">

          <div class="main">

            <div class="input-group">

              <div class="blog_search search_form">

                <input type="search" name="search" class="form-control-main oc-search-input" id="search" >

              </div>

              <div class="input-group-append">

                <button class="btn btn-secondary" id="occ_search_new" type="button" onclick="searchbutton()"> TO SEARCH </button>

              </div>

            </div>

            <div id="loader" class="loader" style="display:none;"></div>

            <main class="main_box_content">

              <section class="blog-grid" id="products"> <?php







           $args = array(



               "posts_per_page" => 4,







               "post_type" => "machine",







               "post_status" => "publish",







               "orderby" => "title",







               "order" => "ASC"











           );











           $the_query = new WP_Query($args);



           if ($the_query->have_posts()) {







               while ($the_query->have_posts()) {



                   $the_query->the_post();







                   $post_id = get_the_ID();







                   $art_code = get_post_meta($post_id, 'art_code', true);











 $top = get_post_meta( $post_id, 'top', true );



           if ($top) {



                 $top = get_post_meta( $post_id, 'top', true );



        };















                   $directoryurl = site_url() . '/IMG/' . $art_code . '/' . $art_code . '_' . '001.jpg';







                   //     $directory_array = scandir($directory);



                   //  unset( $directory_array[0],$directory_array[1] );



           























                   ?> <div class="blog">

                  <div class="blog-img"> <?php if($top=="ja") {



                                                    $topnew="Occasions";



                                                ?> <div class="top_occasions">

                      <h2 class="top">Top</h2>

                      <p class="occasions"> <?php echo $topnew; ?> </p>

                    </div> <?php



}



?> <?php



                                                           //$imgFile = 'http://www.yourdomain.com/images/'.$fileName;



                                                           if (is_file($directoryurl)) {







                                                               ?> <img src="

                                                        <?php echo $directoryurl . '/' . $art_code . '_' . '001.jpg'; ?>"> <?php



                                                           } else {



                                                               ?> <img src="https://abemectest.nl/wp-content/uploads/2023/08/image1.png">

                    <h2 class="blog-title"> <?php the_title(); ?> </h2> <?php







                                                           }



                                                           ?>

                  </div>

                  <div class="grey">

                    <div class="blog-content">

                      <p class="blog-desc"></p>

                      <div class="blog-details">

                        <button id="fancyButton">

                          <a href="

                                                                  <?php the_permalink(); ?>">MORE INFO </a>

                          <span class="right-arrow">&#129170;</span>

                        </button>

                      </div>

                    </div>

                  </div>

                </div> <?php







                                        wp_reset_postdata();



               }



           }







           ?> <?php



          ?> </section>

            </main>

          </div>

        </div>

      </div>

    </div>

    </div>

    </div>

    </div>

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <script>

      $(document).ready(function() {

        $("select.category-all").change(function() {

          var selectedCountry = $(".category-all option:selected").val();

          // alert(selectedCountry);

        });

      });

    </script>

    <script type="text/javascript">

      /* 



* Single



*/

      new SlimSelect({

        select: '#country'

      });

      new SlimSelect({

        select: '#favoritefood'

      });

      /*



      * Multiple



      */

      new SlimSelect({

        select: '#multiple'

      });

      new SlimSelect({

        select: '#moptgroups'

      });

    </script>

    <script type="text/javascript">

      const navEl = document.getElementById("nav-mobile-menu");

      const nav = document.getElementsByTagName("nav");

      navEl.addEventListener("click", () => {

        nav[0].classList.toggle("mobile-menu");

      });

    </script>

    <script type="text/javascript">

      jQuery(document).ready(function() {



      

        jQuery('#filter').submit(filter_form);





        jQuery("#filter   #merk_new select, #Contact_filiaal_new select, #Bouwjaar_new select, #priceinput input, #darian input").on("change", filter_form);







        if (jQuery("#filter  #merk_new select, #Contact_filiaal_new select, #Bouwjaar_new select, #priceinput input, #darian input").filter(function(a) {

            return a.value != '';

          }).length > 0) {

          filter_form();

        }



        function filter_form() {

          jQuery('.select2').css('margin-bottom', '50% !important');

          var filter = jQuery('#filter');

          jQuery('#loader').css('display', 'block');

          var s = jQuery('.oc-search-input').val();

          jQuery('#occ_search').val(s);





          var main_category = jQuery('#main-category').val();

          var main_subcategory = jQuery('#mainsubcategory').val();

          var main_subcategory1 = jQuery('#mainsubcategory1').val();







       

          jQuery.ajax({

            //                                url:filter.attr('action'),

            url: "https://abemectest.nl/wp-admin/admin-ajax.php",

            dataType: 'JSON',

            data: filter.serialize() + "&filter_form=" + filter_form, // form data

            type: filter.attr('method'), // POST

            cache: false,

            beforeSend: function(xhr) {

              filter.find('button').text('Processing...'); // changing the button label

            },

            success: function(data) {

       jQuery('#merk').html(data[0].merk_option);

              jQuery('#loader').css('display', 'none');

              //console.log(data[0].html);

              jQuery("#search").attr("placeholder", "Search all " + data[0].total + " occasions");

              console.log(data[0].total);

              filter.find('button').text('Apply filter'); // changing the button label back

              var url = window.location.pathname;

              url += '?' + filter.serialize();

              window.history.pushState(null, '', url);

              jQuery('#products').html(data[0].html); // insert data

              if (data.post_count != "") {

                //  jQuery('input#search').attr('placeholder', 'Zoek in alle '+data.post_count+' occasions');

              }

    

            }

          });

          return false;

        }

      });

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script type="text/javascript">

      var $range = $(".js-range-slider"),

        $from = $(".from"),

        $to = $(".to"),

        range,

        min = $range.data('min'),

        max = $range.data('max'),

        from,

        to;

      var updateValues = function() {

        $from.prop("value", from);

        $to.prop("value", to);

      };

      $range.ionRangeSlider({

        onChange: function(data) {

          from = data.from;

          to = data.to;

          updateValues();

        }

      });

      range = $range.data("ionRangeSlider");

      var updateRange = function() {

        range.update({

          from: from,

          to: to

        });

      };

      $from.on("input[name='prijsmin']", function() {

        from = +$(this).prop("value");

        if (from < min) {

          from = min;

        }

        if (from > to) {

          from = to;

        }

        updateValues();

        updateRange();

      });

      $to.on("input[name='prijsmax']", function() {

        to = +$(this).prop("value");

        if (to > max) {

          to = max;

        }

        if (to < from) {

          to = from;

        }

        updateValues();

        updateRange();

      });

    </script>

    <script type="text/javascript">

      var $range1 = $(".js-range-slider1"),

        $from1 = $(".from1"),

        $to1 = $(".to1"),

        range1,

        min1 = $range.data('min'),

        max1 = $range.data('max'),

        from1,

        to1;

      var updateValues1 = function() {

        $from1.prop("value", from1);

        $to1.prop("value", to1);

      };

      $range1.ionRangeSlider({

        onChange: function(data) {

          from1 = data.from;

          to1 = data.to;

          updateValues1();

        }

      });

      range1 = $range1.data("ionRangeSlider");

      var updateRange1 = function() {

        range1.update({

          from: from1,

          to: to1

        });

      };

      $from1.on("input[name='draaiurenMin']", function() {

        from1 = +$(this).prop("value");

        if (from1 < min1) {

          from1 = min1;

        }

        if (from1 > to1) {

          from1 = to1;

        }

        updateValues1();

        updateRange1();

      });

      $to1.on("input[name='draaiurenMax']", function() {

        to1 = +$(this).prop("value");

        if (to1 > max1) {

          to1 = max1;

        }

        if (to1 < from1) {

          to1 = from1;

        }

        updateValues1();

        updateRange1();

      });

    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet" />

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

    <script src="<?php echo get_template_directory_uri(); ?>/select2.js"></script>

    

    

    

    

    <script>







   function filter_form_checkboxes() {

        

          var filter = jQuery('#filter');

          jQuery('#loader').css('display', 'block');

          var s = jQuery('.oc-search-input').val();

          jQuery('#occ_search').val(s);





          var main_category = jQuery('#main-category').val();



          var filter_form = '';









          jQuery.ajax({

            url: "https://abemectest.nl/wp-admin/admin-ajax.php",

            dataType: 'JSON',

            data: filter.serialize() + "&filter_form=" + filter_form, // form data

            type: filter.attr('method'), // POST

            cache: false,

            beforeSend: function(xhr) {

              filter.find('button').text('Processing...'); // changing the button label

            },

            success: function(data) {

                jQuery('#merk').html(data[0].merk_option);

              jQuery('#loader').css('display', 'none');

              jQuery("#search").attr("placeholder", "Search all " + data[0].total + " occasions");

              console.log(data[0].total);

              filter.find('button').text('Apply filter'); // changing the button label back

              var url = window.location.pathname;

              url += '?' + filter.serialize();

              window.history.pushState(null, '', url);

              jQuery('#products').html(data[0].html); // insert data

              if (data.post_count != "") {

                //  jQuery('input#search').attr('placeholder', 'Zoek in alle '+data.post_count+' occasions');

              }

          

            }

          });

          return false;

        }







function update_merk() {

        

          var filter = jQuery('#filter');

          jQuery('#loader').css('display', 'block');

          var s = jQuery('.oc-search-input').val();

          jQuery('#occ_search').val(s);





          var main_category = jQuery('#main-category').val();



          var filter_form = '';









          jQuery.ajax({

            url: "https://abemectest.nl/wp-admin/admin-ajax.php",

            dataType: 'JSON',

            data: {'main-category':main_category,'action':'update_merk'}, // form data

            type:'POST', // POST

            cache: false,

           

            success: function(data) {

               

                jQuery('#merk').html(data[0].merk_option);

              jQuery('#loader').css('display', 'none');

              jQuery("#search").attr("placeholder", "Search all " + data[0].total + " occasions");

            

              filter.find('button').text('Apply filter'); // changing the button label back

              var url = window.location.pathname;

              url += '?' + filter.serialize();

              window.history.pushState(null, '', url);

              jQuery('#products').html(data[0].html); // insert data

              if (data.post_count != "") {

                //  jQuery('input#search').attr('placeholder', 'Zoek in alle '+data.post_count+' occasions');

              }

          

            }

          });

          return false;

        }













function showChildCategories(parentCategory,termparentid) {





    $('input[type="checkbox"]').not("#"+termparentid).prop('checked', false);









    var childCategoriesDiv = document.getElementById(parentCategory + '-child-categories');





    if (childCategoriesDiv.style.display === "none") {

        childCategoriesDiv.style.display = "block";

    } else {

        childCategoriesDiv.style.display = "none";

    }





          if( jQuery('#'+termparentid).is(':checked') ){

           

    jQuery('#main-category').val(parentCategory);

}

else{

 

    jQuery('#main-category').val('');

}







           setTimeout(function(){ filter_form_checkboxes();}, 500);

           setTimeout(function(){ update_merk();}, 500);

         

         

    

}



function searchbutton() {

   







           setTimeout(function(){ filter_form_checkboxes();}, 500);

         

         

    

}





function showSubChildCategories(parentCategory,termparentid) {



     $('.subchild').not("#"+termparentid).prop('checked', false);



  

    var subchildCategoriesDivs = document.querySelectorAll('#' + parentCategory + '-sub-child-categories');





    subchildCategoriesDivs.forEach(function(subchildCategoriesDiv) {

        if (subchildCategoriesDiv.style.display === "none") {

            subchildCategoriesDiv.style.display = "block";

        } else {

            subchildCategoriesDiv.style.display = "none";

        }

    });











      if( jQuery('#'+termparentid).is(':checked') ){

           

    jQuery('#main-category').val(parentCategory);

}

else{

 

    jQuery('#main-category').val('');

}

  setTimeout(function(){ filter_form_checkboxes();}, 500);

setTimeout(function(){ update_merk();}, 500);

}

function showSubSubChildCategories(parentCategory,termparentid) {


         $('.subsubchild').not("#"+termparentid).prop('checked', false);

      if( jQuery('#'+termparentid).is(':checked') ){

           

    jQuery('#main-category').val(parentCategory);

}

else{
 jQuery('#main-category').val('');

}

 setTimeout(function(){ filter_form_checkboxes();}, 500);

setTimeout(function(){ update_merk();}, 500);


}

</script>


  </body>

</html>
