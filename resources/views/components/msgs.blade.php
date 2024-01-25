<div>

                    @if ($errors->any())
                    <div class="alert alert-danger alert-spacing font-15 m-l-22 m-r-22">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(session()->has('success'))
                        @if (session()->get('success')->status)
                        <div class="row clearfix">
                            <div class="col s12">
                                    <div class="alert alert-success alert-spacing font-15 m-l-22 m-r-22" >
                                        {{ session()->get('success')->msg }}
                                    </div>

                            </div>
                        </div>
                        @endif
                    @endif


</div>