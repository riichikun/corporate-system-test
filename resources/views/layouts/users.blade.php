<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div x-data>
                        <table>
                            <tr>
                                <th>Username</th>
                                <th>Roles</th>
                                @if (!empty(in_array('Super Admin', $roles)))
                                <th>Admin actions</th>
                                @endif
                            </tr>
                            @foreach ($users as $user)
                                <tr class="p-[10px]">
                                    <td class="p-[10px]">
                                        <p> {{ $user->name }} </p>                                        
                                    </td>
                                    <td class="p-[10px]">
                                    @php
                                        $userRoles = $user->roles()->get()->keyBy('name');
                                        $path = url("/admin");
                                    @endphp
                                    @if ($userRoles->count() === 0)
                                        <p> User </p>
                                    @else
                                        @foreach ($userRoles as $userRole)
                                            <p> {{ $userRole->name }} </p>
                                        @endforeach
                                    @endif
                                    </td>
                                    @if (!empty(in_array('Super Admin', $roles))
                                        && (empty($userRoles->count())
                                        || !isset($userRoles['Admin'])
                                            && !isset($userRoles['Super Admin'])
                                        ))
                                    <td>    
                                        <form x-data>
                                            @csrf
                                            <button @click="setRole" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                <input type="submit" value="Make admin">    
                                            </button>        
                                        </form>
                                    </td>  
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</x-app-layout>
<script>
    function setRole() {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch("{{ route('users.index') . '/' . $user->id . '/roles/' . 2}}", {
            headers: {
                "X-CSRF-TOKEN": token
            },
            method: 'post',
            redirect: "follow"
        })
    }
</script>