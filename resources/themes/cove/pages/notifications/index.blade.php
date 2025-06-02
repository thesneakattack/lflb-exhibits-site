<?php
    use function Laravel\Folio\{middleware, name};
	use Livewire\Volt\Component;
    name('notifications');
    middleware('auth');

	new class extends Component{

		public $notifications_count;
		public $unreadNotifications;
		 
		public function mount(){
			$this->updateNotifications();
		}

		public function delete($id){
			$notification = auth()->user()->notifications()->where('id', $id)->first();
			if ($notification){
				$notification->delete();
			}
			$this->updateNotifications();
		}

		public function updateNotifications(){
			$this->setUnreadNotifications = $this->unreadNotifications = auth()->user()->unreadNotifications->all();  
			$this->notifications_count = auth()->user()->unreadNotifications->count();}
		}
?>

<x-layouts.app>
	@volt('notifications')
		<x-app.container>
			<x-back-button text="Back to Dashboard" href="/dashboard"></x-back-button>
			<h1 class="flex items-center mb-10 text-3xl font-bold text-gray-700">
				<svg class="mr-1 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
				All Notifications
			</h1>
			<x-card>	
				<div class="overflow-hidden relative top-0 right-0 w-full max-w-7xl origin-top">
					<div class="bg-white rounded-md">
						<div id="notifications-none" class="@if($notifications_count > 0){{ 'hidden' }}@endif bg-zinc-150 flex items-center justify-center h-24 w-full text-zinc-600 font-medium">
							<svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
							All Caught Up!
						</div>

						<div class="relative">
							@foreach ($unreadNotifications as $index => $notification)
								@php $notification_data = (object)$notification->data; @endphp
								<div id="notification-li-{{ $index + 1 }}" class="flex flex-col pb-5 border-b border-zinc-200 hover:bg-gray-50">
									<a href="{{ @$notification_data->link }}" class="flex items-start p-5 pb-2">
										<span class="flex-shrink-0 pt-1">
											<img class="w-10 h-10 rounded-full" src="{{ @$notification_data->icon }}" alt="">
										</span>
										<span class="flex flex-col flex-1 items-start ml-3 w-0">
											<span class="text-sm leading-5 text-zinc-600">
												<strong>{{ @$notification_data->user['name'] }} @if(isset($notification_data->type) && @$notification_data->type == 'message'){{ 'left a message' }}@else{{ 'said' }}@endif</strong>
												{{ @$notification_data->body }}
											</span>
											<span class="mt-2 text-sm font-medium leading-5 text-zinc-500">
												<span class="notification-datetime">{{ \Carbon\Carbon::parse(@$notification->created_at)->format('F, jS h:i A') }}</span>
											</span>
										</span>
									</a>
									<span wire:click="delete('{{ $notification->id }}')" class="flex justify-start py-1 pl-16 ml-1 w-full text-xs cursor-pointer text-zinc-500 k hover:text-zinc-700 mark-as-read hover:underline">
										<svg class="absolute mt-1 mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
										<svg class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
										Mark as Read
									</span>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</x-card>
		</x-app.container>
	@endvolt
</x-layouts.app>