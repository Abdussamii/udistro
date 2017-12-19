<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovingItemServiceRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'agent_client_id', 'invitation_id', 'mover_company_id', 'items_in_storage_locker_already', 'needs_to_move_things_from_basement', 'move_items_from_my_garage_include_also', 'move_play_structure_from_nursery', 'need_children_swing_set', 'need_packing_services', 'need_packing_boxes', 'need_to_dismantle_reassemble_items',
		'need_storage', 'need_transportation_of_vehicle', 'packing_issue', 'callback_option', 'callback_time', 'primary_no', 'secondary_no', 'moving_date', 'additional_information',
    ];

    public $timestamps = true;
}
