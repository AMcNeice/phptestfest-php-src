--TEST--
Bug #47054 (BC break in static functions called as dynamic)
--FILE--
<?php

class C {
  final static function s() {
    print "Called class: " . get_called_class() . "\n";
  }
}
class D extends C {
  public function m() {
    $this->s();
  }
}

$d = new D();
$d->m();

C::s();

$c = new C();
$c->s();

get_called_class();

D::m();

?>
--EXPECTF--
Called class: D
Called class: C
Called class: C

Warning: get_called_class() called from outside a class in %s on line %d

Deprecated: Non-static method D::m() should not be called statically in %s on line %d

Fatal error: Uncaught Error: Using $this when not in object context in %s:%d
Stack trace:
#0 %s(%d): D::m()
#1 {main}
  thrown in %s on line %d
