<?php

namespace App\Orchid\Layouts;

use App\Models\Client;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class ClientsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'clients';

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
                ->render(function (Client $client) {
                    return Link::make($client->name)
                        ->route('platform.client.edit', $client);
                }),
            TD::make('mail', __('mail'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Client $client) {
                    return $client->mail;
                }),
            TD::make('phone', __('phone'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Client $client) {
                    return $client->phone;
                }),
            TD::make('preference', __('preference'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Client $client) {
                    return $client->preference;
                }),
        ];
    }
}
