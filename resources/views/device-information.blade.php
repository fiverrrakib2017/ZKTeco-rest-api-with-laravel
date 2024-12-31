@extends('layout.layout')

@section('content')
<div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="p-6">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                <div class="ml-4 text-lg leading-7 font-semibold"><a href="#" class=" text-gray-900 dark:text-white">
                Laravel Zkteco <b>( iclock9000-G )</b>
                </a></div>
            </div>
            <br/>
            <div class="ml-12">
                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                    <img src="{{ asset('machine.jpg') }}" style="width: 100%;"/>
                </div>
            </div>
        </div>

        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
            <a href="{{ route('machine.home') }}" class="btn btn-success" style="float:right">
                Back to home
            </a>

            <div class="flex items-center">
                <br/><br/>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laracasts.com" class="underline text-gray-900 dark:text-white">Device information</a></div>
            </div>
            <hr/>
            <div class="ml-12">
                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Information</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Device IP</td>
                            <td>{{ $deviceip }}</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>Device Name</td>
                            <td>{{ $devicedeviceName }}</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Device Version</td>
                            <td>{{ $deviceVersion }}</td>
                          </tr>
                          <tr>
                            <th scope="row">4</th>
                            <td>Device OS Version</td>
                            <td>{{ $deviceOSVersion }}</td>
                          </tr>
                          <tr>
                            <th scope="row">5</th>
                            <td>Device Platform</td>
                            <td>{{ $devicePlatform }}</td>
                          </tr>
                          <tr>
                            <th scope="row">6</th>
                            <td>Device Fm Version</td>
                            <td>{{ $devicefmVersion }}</td>
                          </tr>
                          <tr>
                            <th scope="row">7</th>
                            <td>Device Work Code</td>
                            <td>{{ $deviceworkCode }}</td>
                          </tr>
                          <tr>
                            <th scope="row">8</th>
                            <td>Device SSR</td>
                            <td>{{ $devicessr }}</td>
                          </tr>
                          <tr>
                            <th scope="row">9</th>
                            <td>Device Epin Width</td>
                            <td>{{ $devicepinWidth }}</td>
                          </tr>
                          <tr>
                            <th scope="row">10</th>
                            <td>Device Serial Number</td>
                            <td>{{ $deviceserialNumber }}</td>
                          </tr>
                          <tr>
                            <th scope="row">11</th>
                            <td>Device Time</td>
                            <td>{{ $devicegetTime }}</td>
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div>
            
        </div>

    </div>
</div>
@endsection