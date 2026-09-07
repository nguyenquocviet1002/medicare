<?php
/**
 * Custom Walker Nav Menu for Mega Menu Header
 *
 * Renders top-level items as .header__menu-item.
 * Items with children get --has-submenu class + toggle button + .header__submenu wrapper.
 * Supports mega menu types via CSS classes on the menu item:
 *   - 'mega-single'    -> .header__submenu--single (single column)
 *   - 'mega-2col'      -> two columns
 *   - default          -> two columns
 *
 * Recommended menu structure (depth 0-2):
 *   Điều Trị (has children, class mega-2col)
 *     ⌄ Buổi Lẻ (has children)                 -> becomes .header__submenu-col
 *         ⌄ LASER                              -> .header__submenu-link
 *         ⌄ PEEL
 *     ⌄ Liệu Trình (has children)
 *         ⌄ ĐIỀU TRỊ MỤN
 *
 * For single-column mega menus, use the 'mega-single' class:
 *   Thẩm Mỹ (has children, class mega-single)
 *     ⌄ CFU ÈLIFE                              -> .header__submenu-link
 *     ⌄ COMBO
 *
 * @package Medicare_Clinic
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Medicare_Walker_Nav_Menu extends Walker_Nav_Menu {

    /**
     * Track the submenu type (mega-single / mega-2col) for the current item.
     */
    protected $current_mega_type = '';

    /**
     * Starts the list before the elements are added.
     */
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        if ( $depth === 0 ) {
            $modifier = ( $this->current_mega_type === 'mega-single' ) ? ' header__submenu--single' : '';
            $output .= '<div class="header__submenu' . $modifier . '">';
        } elseif ( $depth === 1 ) {
            // Each depth-1 item is a column within the mega menu
            if ( $this->current_mega_type !== 'mega-single' ) {
                $output .= '<div class="header__submenu-col">';
            }
        } else {
            $output .= '<ul class="header__submenu-inner">';
        }
    }

    /**
     * Ends the list after the elements are added.
     */
    public function end_lvl( &$output, $depth = 0, $args = null ) {
        if ( $depth === 0 ) {
            $output .= '</div>';
        } elseif ( $depth === 1 ) {
            if ( $this->current_mega_type !== 'mega-single' ) {
                $output .= '</div>';
            }
        } else {
            $output .= '</ul>';
        }
    }

    /**
     * Starts the element output.
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes   = empty( $item->classes ) ? array() : (array) $item->classes;
        $has_sub   = in_array( 'menu-item-has-children', $classes, true );
        $is_active = in_array( 'current-menu-item', $classes, true ) || in_array( 'current-menu-ancestor', $classes, true );

        // Detect mega menu type from custom CSS class (top-level items only)
        if ( $depth === 0 && in_array( 'mega-single', $classes, true ) ) {
            $this->current_mega_type = 'mega-single';
        } elseif ( $depth === 0 ) {
            $this->current_mega_type = 'mega-2col';
        }

        // ── Top-level items (depth 0) ──
        if ( $depth === 0 ) {
            $li_classes = 'header__menu-item';
            if ( $has_sub ) $li_classes .= ' header__menu-item--has-submenu';

            $output .= '<li class="' . esc_attr( $li_classes ) . '">';

            $link_class = 'header__menu-link';
            if ( $is_active ) $link_class .= ' header__menu-link--active';

            $output .= '<a href="' . esc_url( $item->url ) . '" class="' . esc_attr( $link_class ) . '">';
            $output .= esc_html( $item->title );
            $output .= '</a>';

            if ( $has_sub ) {
                $output .= '<button class="header__submenu-toggle" type="button" aria-expanded="false" aria-label="Mở/đóng menu con ' . esc_attr( $item->title ) . '"></button>';
            }

        // ── Depth 1: column or single-column link ──
        } elseif ( $depth === 1 ) {
            if ( $this->current_mega_type === 'mega-single' ) {
                // Direct link in a single-column mega menu
                $output .= '<a href="' . esc_url( $item->url ) . '" class="header__submenu-link">';
                $output .= esc_html( $item->title );
                $output .= '</a>';
            } else {
                // Column title within 2-column mega menu
                $title_class = 'header__submenu-title';
                $output .= '<a href="' . esc_url( $item->url ) . '" class="' . esc_attr( $title_class ) . '">';
                $output .= esc_html( $item->title );
                $output .= '</a>';
            }

        // ── Depth 2: submenu links inside a column ──
        } else {
            $output .= '<a href="' . esc_url( $item->url ) . '" class="header__submenu-link">';
            $output .= esc_html( $item->title );
            $output .= '</a>';
        }
    }

    /**
     * Ends the element output.
     */
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        if ( $depth === 0 ) {
            $output .= '</li>';
        }
        // Non-wrapping anchor elements (depth 1+) close themselves.
    }
}


/**
 * Simple Footer Nav Walker
 * Outputs each top-level menu item as a .footer__col with title + nav list.
 */
class Medicare_Footer_Nav_Walker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="footer__nav-list">';
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        if ( $depth === 0 ) {
            $output .= '<div class="footer__col">';
            $output .= '<h4 class="footer__title">' . esc_html( $item->title ) . '</h4>';
        } else {
            $output .= '<li class="footer__nav-item">';
            $output .= '<a href="' . esc_url( $item->url ) . '" class="footer__nav-link">';
            $output .= esc_html( $item->title );
            $output .= '</a>';
        }
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        if ( $depth === 0 ) {
            $output .= '</div>';
        } else {
            $output .= '</li>';
        }
    }
}
