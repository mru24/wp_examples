<!-- ADD TO FUNCTIONS.PHP -->

<?php
// step 1 add a location rule type
add_filter('acf/location/rule_types', 'acf_wc_product_type_rule_type');
function acf_wc_product_type_rule_type($choices) {
  // first add the "Product" Category if it does not exist
  // this will be a place to put all custom rules assocaited with woocommerce
  // the reason for checking to see if it exists or not first
  // is just in case another custom rule is added
  if (!isset($choices['Product'])) {
    $choices['Product'] = array();
  }
  // now add the 'Category' rule to it
  if (!isset($choices['Product']['product_cat'])) {
    // product_cat is the taxonomy name for woocommerce products
    $choices['Product']['product_cat_term'] = 'Product Category Term';
  }
  return $choices;
}

// step 2 skip custom rule operators, not needed

// step 3 add custom rule values
add_filter('acf/location/rule_values/product_cat_term', 'acf_wc_product_type_rule_values');
function acf_wc_product_type_rule_values($choices) {
  // basically we need to get an list of all product categories
  // and put the into an array for choices
  $args = array(
    'taxonomy' => 'product_cat',
    'hide_empty' => false
  );
  $terms = get_terms($args);
  foreach ($terms as $term) {
    $choices[$term->term_id] = $term->name;
  }
  return $choices;
}

// step 4, rule match
add_filter('acf/location/rule_match/product_cat_term', 'acf_wc_product_type_rule_match', 10, 3);
function acf_wc_product_type_rule_match($match, $rule, $options) {
  if (!isset($_GET['tag_ID'])) {
    // tag id is not set
    return $match;
  }
  if ($rule['operator'] == '==') {
    $match = ($rule['value'] == $_GET['tag_ID']);
  } else {
    $match = !($rule['value'] == $_GET['tag_ID']);
  }
  return $match;
}
