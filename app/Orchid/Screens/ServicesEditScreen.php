<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Service;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Alert;
use Illuminate\Http\Request;

class ServicesEditScreen extends Screen
{
    public $service;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Service $service): iterable
    {
        return [
            'service' => $service
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'ServiceEditScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create service')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->service->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->service->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->service->exists),
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
                Input::make('service.client_id')
                    ->title('id Клиента')
                    ->required(),
                Input::make('service.name')
                    ->title('Название услуги')
                    ->required(),
                Input::make('service.price')
                    ->title('Цена')
                    ->required(),
                Input::make('service.time')
                    ->title('Время услуги')
                    ->required(),
            ])
        ];
    }
    public function createOrUpdate(Request $request)
    {
        $this->service->fill($request->get('service'))->save();

        Alert::info('You have successfully created a service.');

        return redirect()->route('platform.service.list');
    }
    public function remove()
    {
        $this->service->delete();

        Alert::info('You have successfully deleted the service.');

        return redirect()->route('platform.service.list');
    }
}
