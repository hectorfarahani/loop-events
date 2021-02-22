<?php

namespace Loop_Events;

add_filter( 'mime_types', 'loop_events_mime_types' );

function loop_events_mime_types( $mime_types ) {
    $mime_types['json'] = 'application/json';
    return $mime_types;
}
