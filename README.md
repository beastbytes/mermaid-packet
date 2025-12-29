# Mermaid Packet
PHP for [Mermaid.js](https://mermaid.js.org/) diagramming and charting tool packet diagram.

For license information see the [LICENSE](LICENSE.md) file.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist beastbytes/mermaid-packet
```

or add

```json
"beastbytes/mermaid-packet": "{{versionConstraint}}"
```

to the `require` section of your composer.json.

## Usage
### Field
Create fields for the packet. A field can be specified by:
* the start bit only; creates a one bit field
* the start bit and end bit; start() must be called before end()
* the start bit and length
* the length only; the field starts immediately after the previous field

All fields must have a description.

#### Examples
A TCP packet
```php
    $fields = [];
    $fields[] = (new Field('Source Port'))->length(16); // will start at 0
    $fields[] = (new Field('Destination Port'))->length(16);
    $fields[] = (new Field('Sequence Number'))->length(32);
    $fields[] = (new Field('Acknowledgment Number'))->length(32);
    $fields[] = (new Field('Data Offset'))->start(96)->end(99); // start() must be called before end()
    $fields[] = (new Field('Reserved'))->start(100)->length(6);
    $fields[] = (new Field('URG'))->start(106); // 1 bit field
    $fields[] = (new Field('ACK'))->start(107);
    $fields[] = (new Field('PSH'))->start(108);
    $fields[] = (new Field('RST'))->start(109);
    $fields[] = (new Field('SYN'))->start(110)->end(110); // OK
    $fields[] = (new Field('FIN'))->start(111)->length(1); // OK    
    $fields[] = (new Field('Window'))->start(112)->end(127);
    $fields[] = (new Field('Checksum'))->start(128)->end(143);
    $fields[] = (new Field('Urgent Pointer'))->start(144)->end(159);
    $fields[] = (new Field('(Options and Padding)'))->start(160)->end(191));
    $fields[] = (new Field('Data (variable length)'))->start(192)->end(255)');
```

### Packet
Add the fields to, set the title of, then render a packet.

#### Example
```php
    Mermaid::create('Packet')
        ->withTitle('TCP Packet')
        ->withFields(...$someFields) // New set of fields
        ->addFields(...$moreFields) // Append fields if needed
        ->render()
    ;
```

## API
### Field
`Field` represents a bit-field in a packet.

#### __construct()
Creates a new `Field` instance.
##### Parameters
| Name        | Type   | Description              |
|-------------|--------|--------------------------|
| description | string | Description of the field |
**Return Type:** Field

#### start()
Returns a new instance of `Field` with the start bit set.
##### Parameters
| Name  | Type | Description                           |
|-------|------|---------------------------------------|
| start | int  | Start bit of the field (zero indexed) |
**Return Type:** Field

#### end()
Returns a new instance of `Field` with the end bit set.
##### Parameters
| Name | Type | Description                         |
|------|------|-------------------------------------|
| end  | int  | End bit of the field (zero indexed) |
**Return Type:** Field

#### length()
Returns a new instance of `Field` with the length of the field set.
##### Parameters
| Name   | Type | Description             |
|--------|------|-------------------------|
| length | int  | Bit length of the field |
**Return Type:** Field

### Packet
Packet represents a packet.

#### addField()
Returns a new instance of `Packet` with the given Fields added to any existing Fields.
##### Parameters
| Name  | Type     | Description     |
|-------|----------|-----------------|
| field | ...Field | Field(s) to add |
**Return Type:** Packet

#### withField()
Returns a new instance of `Packet` with the given Fields.
##### Parameters
| Name  | Type     | Description     |
|-------|----------|-----------------|
| field | ...Field | Field(s) to add |
**Return Type:** Packet