Packet Class
=============

.. php:class:: Packet

  Represents a Packet diagram

  .. php:method:: render(array $attributes)

    Renders the Packet Mermaid code

    :param array $attributes: HTML attributes for the enclosing <pre> tag
    :returns: The Packet Mermaid code
    :rtype: string

  .. php:method:: addField(Field ...$field)

    Add packet field(s)

    :param Field ...$field: The packet field(s)
    :returns: A new instance of ``Packet`` with the fields added to existing fields
    :rtype: Packet

  .. php:method:: withField(Field ...$field)

    Set packet field(s)

    :param Field ...$field: The packet field(s)
    :returns: A new instance of ``Packet`` with the fields
    :rtype: Packet

  .. php:method:: withTitle(string $title)

    Set the diagram title

    :param string $title: The title
    :returns: A new instance of ``Packet`` with the title
    :rtype: Packet
