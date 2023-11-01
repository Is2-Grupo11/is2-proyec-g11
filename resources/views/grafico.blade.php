<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grafica -') }}
            {{$projects->name}}
        </h2>
    </x-slot>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                 
                <?php $a = 0; 
                        $b=0;
                        $c=0;?>

                @foreach ($backlogs as $backlog)

                        @foreach ($backlog->sprint1 as $sprint)
                            
                            @foreach ($sprint->card1 as $user_story)

                                @foreach($boards as $board)

                                    @if ($board->name === 'To-do' && $board->id ===$user_story->board_list_id)
                                        <?php $a++; ?>
                                                                    
                                            @elseif ($board->name === 'Doing' && $board->id ===$user_story->board_list_id)
                                            <?php $b++; ?>
                                            
                                        @elseif ($board->name === 'Done' && $board->id ===$user_story->board_list_id)
                                        <?php $c++; ?>
                                        
                                    @endif

                                @endforeach
                            @endforeach 
                            
                        @endforeach
                @endforeach



                <div class="row col-6">
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
                
                
                    
                                                  
    

                    <script>
                        
                        const ctx = document.getElementById('myChart').getContext('2d');
                        const myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Pendiente', 'En proceso','Finalizado'],
                                datasets: [{
                                    label: '',
                                    data: [{{$a}}, {{$b}},{{$c}}],
                                    backgroundColor: [
                                        'rgba(249, 6, 6)',
                                        'rgba(255, 206, 86)',
                                        'rgba(47, 134, 19)'                                   
                                        
                                    ],
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </div>
                
            </div>
        </div>
       
    </div>
</x-app-layout>
