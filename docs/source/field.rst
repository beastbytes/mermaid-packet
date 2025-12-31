Field Class
=============

.. php:class:: Field

  Represents a Field within a packet

  .. php:method:: __construct(string $description)

    Creates a new Field

    :param string $description: The field description
    :returns: A Field Mermaid instance
    :rtype: Field

  .. _start:
  .. php:method:: start(int $start)

    Set the start bit (zero indexed) of the field

    If this method is not called (i.e. the start bit is not set)
    the field starts immediately after the preceding field or at bit 0 if there are none

    :param int $start: The start bit
    :returns: A new instance of ``Field`` with the start bit
    :rtype: Field

  .. _end:
  .. php:method:: end(int $end)

    Set the end bit (zero indexed) of the field

    This method can only be called after :ref:`start() <_start>`

    :param int $end: The end bit
    :returns: A new instance of ``Field`` with the end bit
    :rtype: Field

  .. php:method:: length(int $length)

    Set the bit length of the field

    This method cannot be called if :ref:`end() <_end>`

    :param int $length: The bit
    :returns: A new instance of ``Field`` with the bit length
    :rtype: Field
