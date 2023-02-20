<?php

namespace App\Services;

use App\Models\Experience;
use App\Models\Interfaces\StatusInterface;
use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ExperienceService
{
    public function filter(array|null $filterParams)
    {
        $experiences = Experience::query();

        if ($filterParams !== null) {
            foreach ($filterParams as $key => $values) {

                if ($key === 'type') {
                    $experiences->with('type')
                        ->whereHas('type', function (Builder $query) use ($values) {
                            $query->whereIn('id', $values);
                        });
                }

                if ($key === 'trip_type') {
                    $experiences->with('tripType')
                        ->whereHas('tripType', function (Builder $query) use ($values) {
                            $query->whereIn('id', $values);
                        });
                }

                if ($key === 'active_vendor') {
                    $experiences->with('vendor')->Activevendor()->get();
                }

                if ($key === 'available_date') {
                    $experiences->with('packages')
                        ->whereHas('packages', function (Builder $query) use ($values) {
                            $query->where('start_package_activity', '<', $values)->where('end_package_activity', '>', $values)
                                ->where('status', '=', StatusInterface::STATUS_ACTIVE);
                        });
                }
            }

            return $experiences->get();
        }
    }
}