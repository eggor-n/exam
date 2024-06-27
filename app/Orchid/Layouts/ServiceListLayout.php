<?php

namespace App\Orchid\Layouts;

use App\Models\Service;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class ServiceListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'services';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', __('name'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Service $service) {
                    return Link::make($service->name)
                        ->route('platform.service.edit', $service);
                }),
            TD::make('client id', __('client_id'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Service $service) {
                    return $service->client_id;
                }),
            TD::make('price', __('price'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Service $service) {
                    return $service->price;
                }),
            TD::make('time', __('time'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Service $service) {
                    return $service->time;
                }),
        ];
    }
}
