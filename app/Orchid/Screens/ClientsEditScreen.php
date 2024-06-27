<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Client;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Alert;
use Illuminate\Http\Request;

class ClientsEditScreen extends Screen
{
    public $client;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Client $client): iterable
    {
        return [
            'client' => $client
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'ClientsEditScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create client')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->client->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->client->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->client->exists),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('client.name')
                    ->title('Имя')
                    ->required(),
                Input::make('client.mail')
                    ->title('Почта')
                    ->required(),
                Input::make('client.phone')
                    ->title('Номер телефона')
                    ->required(),
                Input::make('client.preference')
                    ->title('Предпочтения')
                    ->required(),
            ])
        ];
    }
    public function createOrUpdate(Request $request)
    {
        $this->client->fill($request->get('client'))->save();

        Alert::info('You have successfully created a client.');

        return redirect()->route('platform.client.list');
    }
    public function remove()
    {
        $this->client->delete();

        Alert::info('You have successfully deleted the client.');

        return redirect()->route('platform.client.list');
    }
}
