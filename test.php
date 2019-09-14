<?php
$branches = [];
        $titles = ['VL', 'KN', 'KL', 'TR', 'SL', 'TL', 'MZ', 'PN', 'UT', 'RK', 'AL', 'MR'];
        foreach ($titles as $title) {
            $branches[] = [
                'title'         => $title,
                'created_at'    => date('now'),
            ];
        };
print_r($branches);
