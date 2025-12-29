<?php

use BeastBytes\Mermaid\Packet\Field;

test('Field', function (Field $field, int $position, int $newPosition, string $expected) {
    expect($field->render($position))->toBe($expected);
    expect($field->getPosition())->toBe($newPosition);
})
    ->with('field')
;

dataset('field', [
    'Source Port' => [(new Field('Source Port'))->length(16), 0, 16, '+16: "Source Port"'],
    'Destination Port' => [(new Field('Destination Port'))->length(16), 16, 32, '+16: "Destination Port"'],
    'Sequence Number' => [(new Field('Sequence Number'))->length(32), 32, 64, '+32: "Sequence Number"'],
    'Acknowledgment Number' => [(new Field('Acknowledgment Number'))->length(32), 64, 96, '+32: "Acknowledgment Number"'],
    'Data Offset' => [(new Field('Data Offset'))->start(96)->end(99), 96, 100, '96-99: "Data Offset"'],
    'Reserved' => [(new Field('Reserved'))->start(100)->length(6), 100, 106, '100-105: "Reserved"'],
    'URG' => [(new Field('URG'))->start(106), 106, 107, '106: "URG"'],
    'ACK' => [(new Field('ACK'))->start(107), 107, 108, '107: "ACK"'],
    'PSH' => [(new Field('PSH'))->start(108), 108, 109, '108: "PSH"'],
    'RST' => [(new Field('RST'))->start(109), 109, 110, '109: "RST"'],
    'SYN' => [(new Field('SYN'))->start(110)->end(110), 110, 111, '110: "SYN"'],
    'FIN' => [(new Field('FIN'))->start(111)->length(1), 111, 112, '111: "FIN"'],
    'Window' => [(new Field('Window'))->start(112)->end(127), 112, 128, '112-127: "Window"'],
    'Checksum' => [(new Field('Checksum'))->start(128)->end(143), 128, 144, '128-143: "Checksum"'],
    'Urgent Pointer' => [(new Field('Urgent Pointer'))->start(144)->end(159), 144, 160, '144-159: "Urgent Pointer"'],
    '(Options and Padding)' => [(new Field('(Options and Padding)'))->start(160)->end(191), 160, 192, '160-191: "(Options and Padding)"'],
    'Data (variable length)' => [(new Field('Data (variable length)'))->start(192)->end(255), 192, 256, '192-255: "Data (variable length)"'],
]);