<?php

use BeastBytes\Mermaid\Mermaid;
use BeastBytes\Mermaid\Packet\Field;

test('Packet', function () {
    $fields = [
        [
            (new Field('Source Port'))->length(16),
            (new Field('Destination Port'))->length(16),
            (new Field('Sequence Number'))->length(32),
            (new Field('Acknowledgment Number'))->length(32),
            (new Field('Data Offset'))->start(96)->end(99),
            (new Field('Reserved'))->start(100)->length(6),
            (new Field('URG'))->start(106),
            (new Field('ACK'))->start(107),
            (new Field('PSH'))->start(108),
            (new Field('RST'))->start(109),
            (new Field('SYN'))->start(110)->end(110),
            (new Field('FIN'))->start(111)->length(1),
        ],
        [
            (new Field('Window'))->start(112)->end(127),
            (new Field('Checksum'))->start(128)->end(143),
            (new Field('Urgent Pointer'))->start(144)->end(159),
            (new Field('(Options and Padding)'))->start(160)->end(191),
            (new Field('Data (variable length)'))->start(192)->end(255),
        ]
    ];

    expect(Mermaid::create('Packet', ['title' => 'TCP Packet'])
        ->withField(...$fields[0])
        ->addField(...$fields[1])
        ->render()
    )
        ->toBe(<<<EXPECTED
<pre class="mermaid">
---
title: TCP Packet
---
packet
+16: "Source Port"
+16: "Destination Port"
+32: "Sequence Number"
+32: "Acknowledgment Number"
96-99: "Data Offset"
100-105: "Reserved"
106: "URG"
107: "ACK"
108: "PSH"
109: "RST"
110: "SYN"
111: "FIN"
112-127: "Window"
128-143: "Checksum"
144-159: "Urgent Pointer"
160-191: "(Options and Padding)"
192-255: "Data (variable length)"
</pre>
EXPECTED)
    ;
});
