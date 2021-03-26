<?php
/**
 * Administration Menu Functions.
 *
 * @package WordPress
 * @subpackage Administration
 */

/**
 * @param string $add
 * @param string $class
 * @return string
 */
function add_cssclass( $add, $class ) {
	$class = empty( $class ) ? $add : $class .= ' ' . $add;
	return $class;
}

/**
 * @param array $menu
 * @return array
 */
function add_menu_classes( $menu ) {
	$first     = false;
	$lastorder = false;
	$i         = 0;
	$mc        = count( $menu );
	foreach ( $menu as $order => $top ) {
		$i++;

		if ( 0 == $order ) { // Dashboard is always shown/single.
			$menu[0][4] = add_cssclass( 'menu-top-first', $top[4] );
			$lastorder  = 0;
			continue;
		}

		if ( 0 === strpos( $top[2], 'separator' ) && false !== $lastorder ) { // If separator.
			$first                 = true;
			$c                     = $menu[ $lastorder ][4];
			$menu[ $lastorder ][4] = add_cssclass( 'menu-top-last', $c );
			continue;
		}

		if ( $first ) {
			$c                 = $menu[ $order ][4];
			$menu[ $order ][4] = add_cssclass( 'menu-top-first', $c );
			$first             = false;
		}

		if ( $mc == $i ) { // Last item.
			$c                 = $menu[ $order ][4];
			$menu[ $order ][4] = add_cssclass( 'menu-top-last', $c );
		}

		$lastorder = $order;
	}

	/**
	 * Filters administration menus array with classes added for top-level items.
	 *
	 * @since 2.7.0
	 *
	 * @param array $menu Associative array of administration menu items.
	 */
	return apply_filters( 'add_menu_classes', $menu );
}