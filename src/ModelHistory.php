<?php
/**
 * Created by PhpStorm.
 * User: aigletter
 * Date: 31.03.19
 * Time: 2:52
 */

namespace Aigletter\ModelHistory;


use Aigletter\ModelHistory\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

trait ModelHistory
{
    public static $historyModel;

    /*public function setModel($model) {
        $this->_model = $model;
    }

    public function getModel() {
        return $this->_model;
    }*/

    /*public function __construct() {
        $this->_model = config('model-history.model');
    }*/

    /**
     * Fire a custom model event for the given event.
     *
     * @param  string  $event
     * @param  string  $method
     * @return mixed|null
     */
    /*protected function fireCustomModelEvent($event, $method)
    {
        if (! isset($this->dispatchesEvents[$event])) {
            return;
        }

        $result = static::$dispatcher->$method(new $this->dispatchesEvents[$event]($this));

        if (! is_null($result)) {
            return $result;
        }
    }*/

    /**
     * Todo
     * @return array
     */
    public function getHistoryAttributes() {
        return [];
    }

    public function getHistoryTypes() {
        return [];
    }

    protected static function bootModelHistory() {

        self::$historyModel = config('model-history.model');

        self::updated(function(Model $model){
            /**
             * @var Changeable $model
             */

            // TODO
            if (\Auth::id()) {
                $changes = [];
                foreach ($model->getDirty() as $key=>$value) {
                    if (!in_array($key, $model->getHistoryAttributes())) {
                        continue;
                    }

                    $oldValue = $model->getOriginal($key);
                    if ($model->hasCast($key)) {
                        $oldValue = $model->castAttribute($key, $oldValue);
                    }
                    $changes[$key] = [
                        'old_value' => $oldValue,
                        'new_value' => $value
                    ];
                }
                if (!empty($changes)) {
                    $changeModel = new self::$historyModel;
                    $changeModel->author_id = \Auth::id();
                    $changeModel->entity_type = get_class($model);
                    $changeModel->entity_id = $model->id;
                    $changeModel->values = $changes;
                    $changeModel->save();
                }
            }
        });
    }

    public function modelHistory() {
        return $this->morphMany(self::$historyModel, 'entity');
    }
}