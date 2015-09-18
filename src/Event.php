<?
namespace Unity;

use League\Event\Emitter;
use Unity\Container\ServiceTrait;
use Unity\Container\ServiceInterface;

class Event extends Emitter implements ServiceInterface {
    use ServiceTrait;
}
