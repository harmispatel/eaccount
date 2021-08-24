<section>
    <aside id="leftsidebar" class="sidebar">
        <?php //echo '<pre>'; print_r(Auth::user()->avatar); die; ?>

        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                @if ( empty(Auth::user()->avatar) )
                    <img class="" width="48" height="48" src="{{ asset('upload/avatar/avatar.png') }}" alt="Avatar"/>
                @else
                    <img class="" width="48" height="48" src="{{ asset(Auth::user()->avatar) }}" alt="Profile Picture"/>
                @endif
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
                <div class="email">{{ Auth::user()->email }}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="{{ route("profile") }}" class=" waves-effect waves-block"><i class="material-icons">person</i>Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="javascript:void(0); document.getElementById('logout-form').submit();"" class=" waves-effect waves-block"><i class="material-icons">input</i>Sign Out</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="dis-none">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->

        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li @if(Request::url() === route('dashboard'))
                    class="active"
                        @endif >
                    <a href="{{ route('dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{--Account Start--}}

                    <li class="{{ Request::segment('1') == 'branch' || Request::segment('1') == 'ledger' || Request::segment('1') == 'bank-cash' || Request::segment('1') =='cr-voucher' ? 'active' : '' }}" >
                        <a class="menu-toggle" href="javascript:void(0);">
                        <i class="fas fa-file-invoice"></i>
                            <span>Account</span>
                        </a>

                        <ul class="ml-menu">

                            {{--Branch  Start--}}
                                <li @if ( config('role_manage.Branch.All')==0 and  config('role_manage.Branch.TrashShow')==0 and config('role_manage.Branch.Create')==0  )
                                    class="dis-none"
                                    @endif  @if(Request::url() === route('branch') or Request::url() === route('branch.create') or Request::url() === route('branch.trashed') or Request::url() === route('branch.active.search') or Request::url() === route('branch.trashed.search') )
                                    class="active "
                                        @endif >
                                    <a class="" @if ( config('role_manage.Branch.All')==0 )
                                                class="dis-none"
                                                @endif href="{{ route('branch') }}">
                                        <i class="fas fa-code-branch"></i>
                                        <span>Branch </span>
                                    </a>
                                </li>
                            {{--Branch End--}}

                            {{--Ledger--}}
                                <li
                                        @if (  config('role_manage.LedgerType.All')==0 and  config('role_manage.LedgerType.TrashShow')==0 and config('role_manage.LedgerType.Create')==0
                                        and
                                        config('role_manage.LedgerGroup.All')==0 and  config('role_manage.LedgerGroup.TrashShow')==0 and config('role_manage.LedgerGroup.Create')==0
                                        and
                                        config('role_manage.LedgerName.All')==0 and  config('role_manage.LedgerName.TrashShow')==0 and config('role_manage.LedgerName.Create')==0

                                        )

                                        class="dis-none"
                                        @endif

                                        @if(Request::url() === route('income_expense_type')
                                        or Request::url() === route('income_expense_type.create')
                                        or Request::url() === route('income_expense_type.trashed')
                                        or Request::url() === route('income_expense_type.active.search')
                                        or Request::url() === route('income_expense_type.trashed.search')

                                        or Request::url() === route('income_expense_group')
                                        or Request::url() === route('income_expense_group.create')
                                        or Request::url() === route('income_expense_group.trashed')
                                        or Request::url() === route('income_expense_group.active.search')
                                        or Request::url() === route('income_expense_group.trashed.search')




                                        or Request::url() === route('income_expense_head')
                                        or Request::url() === route('income_expense_head.create')
                                        or Request::url() === route('income_expense_head.trashed')
                                        or Request::url() === route('income_expense_head.active.search')
                                        or Request::url() === route('income_expense_head.trashed.search')



                                    )
                                        class="active"
                                        @endif >
                                    <a class="menu-toggle" href="javascript:void(0);">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                        <span>Ledger </span>
                                    </a>
                                    <ul class="ml-menu">

                                        {{--Ledger Type Start--}}
                                        <li @if ( config('role_manage.LedgerType.All')==0 and  config('role_manage.LedgerType.TrashShow')==0 and config('role_manage.LedgerType.Create')==0 )
                                            class="dis-none"
                                            @endif  @if(Request::url() === route('income_expense_type')
                                            or Request::url() === route('income_expense_type.create')
                                            or Request::url() === route('income_expense_type.trashed')
                                            or Request::url() === route('income_expense_type.active.search')
                                            or Request::url() === route('income_expense_type.trashed.search') )
                                            class="active "
                                                @endif >
                                            <a class="" @if ( config('role_manage.LedgerType.All')==0 ) class="dis-none" @endif href="{{ route('income_expense_type') }}">
                                                <span>Type </span>
                                            </a>
                                        </li>

                                        {{--Income Expense Type End--}}


                                        {{--Ledger Group Start--}}
                                        <li @if ( config('role_manage.LedgerGroup.All')==0 and  config('role_manage.LedgerGroup.TrashShow')==0 and config('role_manage.LedgerGroup.Create')==0 )
                                            class="dis-none"
                                            @endif  @if(Request::url() === route('income_expense_group')
                                            or Request::url() === route('income_expense_group.create')
                                            or Request::url() === route('income_expense_group.trashed')
                                            or Request::url() === route('income_expense_group.active.search')
                                            or Request::url() === route('income_expense_group.trashed.search') )
                                            class="active "
                                                @endif >
                                            <a class="" @if ( config('role_manage.LedgerGroup.All')==0) class="dis-none"  @endif href="{{ route('income_expense_group') }}">
                                                <span>Group </span>
                                            </a>

                                        </li>

                                        {{--Ledger Group End--}}


                                        {{--Ledger Name Start--}}

                                        <li @if ( config('role_manage.LedgerName.All')==0 and  config('role_manage.LedgerName.TrashShow')==0 and config('role_manage.LedgerName.Create')==0 )
                                            class="dis-none"
                                            @endif  @if(Request::url() === route('income_expense_head')
                                            or Request::url() === route('income_expense_head.create')
                                            or Request::url() === route('income_expense_head.trashed')
                                            or Request::url() === route('income_expense_head.active.search')
                                            or Request::url() === route('income_expense_head.trashed.search') )
                                            class="active "
                                                @endif >
                                            <a class="" @if ( config('role_manage.LedgerName.All')==0) class="dis-none" @endif href="{{ route('income_expense_head') }}">
                                                <span>Name </span>
                                            </a>
                                        </li>

                                        {{-- Ledger Name End--}}


                                    </ul>

                                </li>
                            {{--Ledger End--}}

                            {{--Bank Cash Start--}}

                            <li @if ( config('role_manage.BankCash.All')==0 and  config('role_manage.BankCash.TrashShow')==0 and config('role_manage.BankCash.Create')==0 )
                                class="dis-none"
                                @endif  @if(Request::url() === route('bank_cash') or Request::url() === route('bank_cash.create') or Request::url() === route('bank_cash.trashed') or Request::url() === route('bank_cash.active.search') or Request::url() === route('bank_cash.trashed.search') )
                                class="active "
                                    @endif >
                                <a class="" @if (config('role_manage.BankCash.All')==0) class="dis-none" @endif href="{{ route('bank_cash') }}">
                                    <i class="fas fa-university"></i>
                                    <span>Bank Cash </span>
                                </a>
                            </li>

                            {{--Bankcash End--}}

                            {{--Voucher Start--}}

                            <li
                                    @if( config('role_manage.CrVoucher.All')==0 and  config('role_manage.CrVoucher.TrashShow')==0 and config('role_manage.CrVoucher.Create')==0

                                    and
                                    config('role_manage.DrVoucher.All')==0 and  config('role_manage.DrVoucher.TrashShow')==0 and config('role_manage.DrVoucher.Create')==0
                                    and
                                    config('role_manage.JnlVoucher.All')==0 and  config('role_manage.JnlVoucher.TrashShow')==0 and config('role_manage.JnlVoucher.Create')==0
                                    and
                                    config('role_manage.ContraVoucher.All')==0 and  config('role_manage.ContraVoucher.TrashShow')==0 and config('role_manage.ContraVoucher.Create')==0


                                    )
                                    class="dis-none"
                                    @endif


                                    @if( Request::url() === route('dr_voucher') or Request::url() === route('dr_voucher.create') or
                            Request::url() === route('dr_voucher.trashed') or Request::url() === route('dr_voucher.active.search') or Request::url() === route('dr_voucher.trashed.search')

                            or Request::url() === route('cr_voucher') or Request::url() === route('cr_voucher.create') or
                            Request::url() === route('cr_voucher.trashed') or Request::url() === route('cr_voucher.active.search') or Request::url() === route('cr_voucher.trashed.search')

                            or Request::url() === route('jnl_voucher') or Request::url() === route('jnl_voucher.create') or
                            Request::url() === route('jnl_voucher.trashed') or Request::url() === route('jnl_voucher.active.search') or Request::url() === route('jnl_voucher.trashed.search')


                            or Request::url() === route('contra_voucher') or Request::url() === route('contra_voucher.create') or
                            Request::url() === route('contra_voucher.trashed') or Request::url() === route('contra_voucher.active.search') or Request::url() === route('contra_voucher.trashed.search')



                            )

                                    class="active "
                                    @endif >
                                <a class="menu-toggle" href="javascript:void(0);">
                                    <i class="material-icons">account_balance_wallet</i>
                                    <span>Voucher</span>
                                </a>

                                <ul class="ml-menu">

                                    {{--Cr Voucher Start--}}

                                    <li @if ( config('role_manage.CrVoucher.All')==0 and  config('role_manage.CrVoucher.TrashShow')==0 and config('role_manage.CrVoucher.Create')==0  )
                                        class="dis-none"
                                        @endif  @if(Request::url() === route('cr_voucher') or Request::url() === route('cr_voucher.create') or Request::url() === route('cr_voucher.trashed') or Request::url() === route('cr_voucher.active.search') or Request::url() === route('cr_voucher.trashed.search') )
                                        class="active "
                                            @endif >
                                        <a class=""  @if (config('role_manage.CrVoucher.All')==0) class="dis-none" @endif href="{{ route('cr_voucher') }}">
                                            <i class="fas fa-arrow-right"></i>
                                            <span>Credit</span>
                                        </a>
                                    </li>

                                    {{--cr Voucher End--}}

                                    {{--Dr Voucher Start--}}

                                    <li @if ( config('role_manage.DrVoucher.All')==0 and  config('role_manage.DrVoucher.TrashShow')==0 and config('role_manage.DrVoucher.Create')==0   )
                                        class="dis-none"
                                        @endif  @if(Request::url() === route('dr_voucher') or Request::url() === route('dr_voucher.create') or Request::url() === route('dr_voucher.trashed') or Request::url() === route('dr_voucher.active.search') or Request::url() === route('dr_voucher.trashed.search') )
                                        class="active "
                                            @endif >
                                        <a class="" @if (config('role_manage.DrVoucher.All')==0 ) class="dis-none"  @endif href="{{ route('dr_voucher') }}">
                                            <i class="fas fa-arrow-left"></i>
                                            <span>Debit</span>
                                        </a>
                                    </li>

                                    {{--Dr Voucher End--}}


                                    {{--Jnl Voucher Start--}}

                                    <li @if ( config('role_manage.JnlVoucher.All')==0 and  config('role_manage.JnlVoucher.TrashShow')==0 and config('role_manage.JnlVoucher.Create')==0  )
                                        class="dis-none"
                                        @endif  @if(Request::url() === route('jnl_voucher') or Request::url() === route('jnl_voucher.create') or Request::url() === route('jnl_voucher.trashed') or Request::url() === route('jnl_voucher.active.search') or Request::url() === route('jnl_voucher.trashed.search') )
                                        class="active "
                                            @endif >
                                        <a class="" @if (config('role_manage.JnlVoucher.All')==0 ) class="dis-none"   @endif href="{{ route('jnl_voucher') }}">
                                            <i class="fas fa-arrows-alt-h"></i>
                                            <span>Journal</span>
                                        </a>
                                    </li>

                                    {{--Jnl Voucher End--}}

                                    {{--contra_voucher Start--}}

                                    <li @if ( config('role_manage.ContraVoucher.All')==0 and  config('role_manage.ContraVoucher.TrashShow')==0 and config('role_manage.ContraVoucher.Create')==0  )
                                        class="dis-none"
                                        @endif  @if(Request::url() === route('contra_voucher') or Request::url() === route('contra_voucher.create') or Request::url() === route('contra_voucher.trashed') or Request::url() === route('contra_voucher.active.search') or Request::url() === route('contra_voucher.trashed.search') )
                                        class="active "
                                            @endif >
                                        <a class="" @if ( config('role_manage.ContraVoucher.All')==0 )  class="dis-none"  @endif href="{{ route('contra_voucher') }}">
                                            <i class="fas fa-arrows-alt-h"></i>
                                            <span>Contra</span>
                                        </a>
                                    </li>

                                    {{--contra_voucher End--}}

                                </ul>
                            </li>

                            {{--Voucher End--}}

                            {{--Opening Balance Start--}}

                                <li

                                        @if (config('role_manage.InitialIncomeExpenseHeadBalance.All')==0 and  config('role_manage.InitialIncomeExpenseHeadBalance.TrashShow')==0 and config('role_manage.InitialIncomeExpenseHeadBalance.Create')==0
                                            and
                                            config('role_manage.InitialBankCashBalance.All')==0 and  config('role_manage.InitialBankCashBalance.TrashShow')==0 and config('role_manage.InitialBankCashBalance.Create')==0


                                        )
                                        class="dis-none"
                                        @endif


                                        @if( Request::url() === route('initial_bank_cash_balance') or Request::url() === route('initial_bank_cash_balance.create') or
                                        Request::url() === route('initial_bank_cash_balance.trashed') or Request::url() === route('initial_bank_cash_balance.active.search') or Request::url() === route('initial_bank_cash_balance.trashed.search')
                                        or
                                        Request::url() === route('initial_income_expense_head_balance') or Request::url() === route('initial_income_expense_head_balance.create') or
                                        Request::url() === route('initial_income_expense_head_balance.trashed') or Request::url() === route('initial_income_expense_head_balance.active.search') or Request::url() === route('initial_income_expense_head_balance.trashed.search')



                                ) class="active " @endif >
                                    <a class="menu-toggle" href="javascript:void(0);">
                                        <i class="fas fa-balance-scale"></i>
                                        <span>Initial <br> Balance</span>
                                    </a>

                                    <ul class="ml-menu">

                                        {{-- Initial Bank Cash Balance Start--}}

                                        <li @if ( config('role_manage.InitialBankCashBalance.All')==0 and  config('role_manage.InitialBankCashBalance.TrashShow')==0 and config('role_manage.InitialBankCashBalance.Create')==0 )
                                            class="dis-none"
                                            @endif  @if(Request::url() === route('initial_bank_cash_balance') or Request::url() === route('initial_bank_cash_balance.create') or Request::url() === route('initial_bank_cash_balance.trashed') or Request::url() === route('initial_bank_cash_balance.active.search') or Request::url() === route('initial_bank_cash_balance.trashed.search') )
                                            class="active "
                                                @endif >
                                            <a class="" @if (config('role_manage.InitialBankCashBalance.All')==0) class="dis-none" @endif href="{{ route('initial_bank_cash_balance') }}">
                                                <span>Bank or <br> Cash </span>
                                            </a>
                                        </li>

                                        {{--Initial Bank Cash Balance End--}}


                                        {{--initial_income_expense_head_balance Start--}}


                                        <li @if ( config('role_manage.InitialIncomeExpenseHeadBalance.All')==0 and  config('role_manage.InitialIncomeExpenseHeadBalance.TrashShow')==0 and config('role_manage.InitialIncomeExpenseHeadBalance.Create')==0)
                                            class="dis-none"
                                            @endif  @if(Request::url() === route('initial_income_expense_head_balance') or Request::url() === route('initial_income_expense_head_balance.create') or Request::url() === route('initial_income_expense_head_balance.trashed') or Request::url() === route('initial_income_expense_head_balance.active.search') or Request::url() === route('initial_income_expense_head_balance.trashed.search') )
                                            class="active "
                                                @endif >
                                            <a class="" @if (config('role_manage.InitialIncomeExpenseHeadBalance.All')==0) class="dis-none" @endif href="{{ route('initial_income_expense_head_balance') }}">
                                                <span>Ledger</span>
                                            </a>     
                                        </li>
                                        {{--initial_income_expense_head_balance End--}}
                                    </ul>
                                </li>

                            {{--Opening Balance end--}}


                        </ul>
                    </li>

                {{--Account End--}}

                {{--Procurement Start--}}

                    <li>
                        <a class="menu-toggle" href="javascript:void(0);">
                        <i class="fas fa-sitemap"></i>
                            <span>Procurement</span>
                        </a>

                        <ul class="ml-menu">
                        
                        </ul>
                    </li>

                {{--Procurement End--}}

                {{--Hr Start--}}

                    <li>
                        <a class="menu-toggle" href="javascript:void(0);">
                        <i class="fas fa-users"></i>
                            <span>HR</span>
                        </a>

                        <ul class="ml-menu">
                        
                        </ul>
                    </li>

                {{--Hr End--}}

                {{--Fiancial Start--}}

                    <li>
                        <a class="menu-toggle" href="javascript:void(0);">
                        <i class="fas fa-donate"></i>
                            <span>Finance</span>
                        </a>

                        <ul class="ml-menu">
                            
                        </ul>
                    </li>

                {{--Fiancial End--}}

                {{--Project Start--}}

                <?php

                $AccountsShow = (config('role_manage.Project.All') or config('role_manage.Cost_item.All') or config('role_manage.Activity.All'));
                ?>
                <li @if( $AccountsShow ==false)
                    class="dis-none"
                    @endif

                    @if( Request::segment('1') == 'project' || Request::segment('1') == 'activity' || Request::segment('1') == 'cost_item')class="active " @endif>
                    <a class="" @if (config('role_manage.Project.All')==0)
                                class="dis-none"
                                @endif href="{{ route('project') }}">
                        <i class="fas fa-project-diagram"></i>
                        <span>Project</span>
                    </a>
                    {{-- <ul class="ml-menu"> --}}
                         {{--Project start--}}
                        {{-- <li @if ( config('role_manage.Project.All')==0 and  config('role_manage.Project.TrashShow')==0 and config('role_manage.Project.Create')==0  )
                        class="dis-none"
                        @endif  @if(Request::url() === route('project') or Request::url() === route('project.create') or Request::url() === route('project.trashed') or Request::url() === route('project.active.search') or Request::url() === route('project.trashed.search') )
                        class="active "
                            @endif >
                                <a class="" @if (config('role_manage.Project.All')==0)
                                            class="dis-none"
                                            @endif href="{{ route('project') }}">
                                    <i class="fas fa-project-diagram"></i>
                                    <span>Project</span>
                                </a>
                        </li> --}}
                         {{--Project End--}}
                         {{--Activity activity Start--}}
                        {{-- <li @if ( config('role_manage.Activity.All')==0 and  config('role_manage.Activity.TrashShow')==0 and config('role_manage.Activity.Create')==0  )
                        class="dis-none"
                        @endif  @if(Request::url() === route('activity') or Request::url() === route('activity.create') or Request::url() === route('activity.trashed') or Request::url() === route('activity.active.search') or Request::url() === route('activity.trashed.search') )
                        class="active "
                            @endif >
                            <a class="" @if (config('role_manage.Activity.All')==0)
                                    class="dis-none"
                                    @endif href="{{ route('activity') }}">
                                    <i class="fas fa-chart-line"></i>
                                <span>Activity</span>
                            </a>
                        </li> --}}
                        {{--Activity End--}}
                        {{--Cost_item cost_item Start--}}
                        {{-- <li @if ( config('role_manage.Cost_item.All')==0 and  config('role_manage.Cost_item.TrashShow')==0 and config('role_manage.Cost_item.Create')==0  )
                        class="dis-none"
                        @endif  @if(Request::url() === route('cost_item') or Request::url() === route('cost_item.create') or Request::url() === route('cost_item.trashed') or Request::url() === route('cost_item.active.search') or Request::url() === route('cost_item.trashed.search') )
                        class="active "
                            @endif >
                            <a class="" @if (config('role_manage.Cost_item.All')==0)
                                class="dis-none"
                                        @endif href="{{ route('cost_item') }}">
                                    <i class="fas fa-money-bill"></i>
                                <span>Cost Item</span>
                            </a>
                        </li> --}}
                        {{--Cost Item End--}}
                    {{-- </ul> --}}
                </li>
                {{--Project End--}}
                
                {{--Report Start--}}

                <?php

                $AccountsShow = (config('role_manage.Ledger.All') or config('role_manage.TrialBalance.All') or config('role_manage.CostOfRevenue.All')
                    or config('role_manage.ProfitOrLossAccount.All') or config('role_manage.RetainedEarning.All') or config('role_manage.FixedAssetsSchedule.All')
                    or config('role_manage.StatementOfFinancialPosition.All') or config('role_manage.CashFlow.All') or config('role_manage.ReceiveAndPayment.All')
                    or config('role_manage.Notes.All'));


                $generalShow = (config('role_manage.GeneralBranch.All') or config('role_manage.GeneralLedger.All')
                    or config('role_manage.GeneralBankCash.All') or config('role_manage.GeneralVoucher.All'));

                ?>


                <li @if( $AccountsShow ==false and $generalShow==false )
                    class="dis-none"
                    @endif

                    @if(Request::url() === route('reports.accounts.ledger')

                    Or
                    Request::url() === route('reports.accounts.trial_balance')
                    Or
                    Request::url() === route('reports.accounts.cost_of_revenue')

                    Or
                    Request::url() === route('reports.accounts.profit_or_loss_account')

                    Or
                    Request::url() === route('reports.accounts.retained_earnings')

                    Or
                    Request::url() === route('reports.accounts.fixed_asset_schedule')

                    Or
                    Request::url() === route('reports.accounts.balance_sheet')

                    Or
                    Request::url() === route('reports.accounts.receive_payment')

                    Or
                    Request::url() === route('reports.accounts.notes')

                    Or
                    Request::url() === route('reports.accounts.cash_flow')



                    Or
                    Request::url() === route('reports.general.branch')

                    Or
                    Request::url() === route('reports.general.ledger.type')

                    Or
                    Request::url() === route('reports.general.bank_cash')

                    Or
                    Request::url() === route('reports.general.voucher')

                     )
                    class="active "
                        @endif>
                    <a class="menu-toggle" href="javascript:void(0);">
                        <i class="fas fa-receipt"></i>
                        <span>Report</span>
                    </a>
                    <ul class="ml-menu">
                        {{--Accounts Report Start--}}
                        <li
                                @if($AccountsShow == false)
                                class="dis-none"
                                @endif

                                @if(Request::url() === route('reports.accounts.ledger')

                        Or
                        Request::url() === route('reports.accounts.trial_balance')
                        Or
                        Request::url() === route('reports.accounts.cost_of_revenue')
                        Or
                        Request::url() === route('reports.accounts.profit_or_loss_account')

                        Or
                        Request::url() === route('reports.accounts.retained_earnings')

                        Or
                        Request::url() === route('reports.accounts.fixed_asset_schedule')

                        Or
                        Request::url() === route('reports.accounts.balance_sheet')

                        Or
                        Request::url() === route('reports.accounts.receive_payment')

                        Or
                        Request::url() === route('reports.accounts.notes')

                        Or
                        Request::url() === route('reports.accounts.cash_flow')





                         )
                                class="active "
                                @endif >
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>Accounts </span>
                            </a>


                            <ul class="ml-menu">
                                <li @if( config('role_manage.Ledger.All')==0 )
                                    class="dis-none"
                                    @endif

                                    @if(Request::url() === route('reports.accounts.ledger')

                     )
                                    class="active "
                                        @endif>
                                    <a href="{{ route('reports.accounts.ledger') }}">Ledger</a>
                                </li>

                                <li @if( config('role_manage.TrialBalance.All')==0 )
                                    class="dis-none"
                                    @endif
                                    @if(Request::url() === route('reports.accounts.trial_balance')

                     )
                                    class="active "
                                        @endif>
                                    <a href="{{ route('reports.accounts.trial_balance') }}">Trial Balance</a>
                                </li>

                                <li @if( config('role_manage.CostOfRevenue.All')==0 )
                                    class="dis-none"
                                    @endif
                                    @if(Request::url() === route('reports.accounts.cost_of_revenue')

                     )
                                    class="active "
                                        @endif>
                                    <a href="{{ route('reports.accounts.cost_of_revenue')  }}">Cost Of Revenue</a>
                                </li>
                                <li
                                        @if( config('role_manage.ProfitOrLossAccount.All')==0 )
                                        class="dis-none"
                                        @endif

                                        @if(Request::url() === route('reports.accounts.profit_or_loss_account')

                         )
                                        class="active "
                                        @endif>
                                    <a href="{{ route('reports.accounts.profit_or_loss_account')  }}">Profit Or loss
                                        account</a>
                                </li>
                                <li @if( config('role_manage.RetainedEarning.All')==0 )
                                    class="dis-none"
                                    @endif

                                    @if(Request::url() === route('reports.accounts.retained_earnings')

                         )
                                    class="active "
                                        @endif>
                                    <a href="{{ route('reports.accounts.retained_earnings')  }}">Retained earnings</a>
                                </li>
                                <li @if( config('role_manage.FixedAssetsSchedule.All')==0 )
                                    class="dis-none"
                                    @endif

                                    @if(Request::url() === route('reports.accounts.fixed_asset_schedule')

                         )
                                    class="active "
                                        @endif >
                                    <a href="{{ route('reports.accounts.fixed_asset_schedule') }}">Fixed Asset
                                        Schedule</a>
                                </li>
                                <li
                                        @if( config('role_manage.StatementOfFinancialPosition.All')==0 )
                                        class="dis-none"
                                        @endif

                                        @if(Request::url() === route('reports.accounts.balance_sheet')

                         )
                                        class="active "
                                        @endif >
                                    <a href=" {{ route('reports.accounts.balance_sheet') }} ">Balance sheet</a>
                                </li>

                                <li @if( config('role_manage.CashFlow.All')==0 )
                                    class="dis-none"
                                    @endif

                                    @if( Request::url() === route('reports.accounts.cash_flow') )
                                    class="active"
                                        @endif >
                                    <a href="{{ route('reports.accounts.cash_flow') }}">Cash flow</a>
                                </li>

                                <li
                                        @if( config('role_manage.ReceiveAndPayment.All')==0 )
                                        class="dis-none"
                                        @endif

                                        @if(Request::url() === route('reports.accounts.receive_payment')

                         )
                                        class="active "
                                        @endif >
                                    <a href="{{ route('reports.accounts.receive_payment')  }}">Receive Payment</a>
                                </li>

                                <li
                                        @if( config('role_manage.Notes.All')==0 )
                                        class="dis-none"
                                        @endif

                                        @if(Request::url() === route('reports.accounts.notes')

                         )
                                        class="active "
                                        @endif >
                                    <a href="{{ route('reports.accounts.notes')  }}">Notes</a>
                                </li>


                            </ul>
                        </li>

                        {{--Accounts Report End--}}

                        {{--General Report Start--}}
                        <li @if($generalShow == false)
                            class="dis-none"
                            @endif

                            @if(Request::url() === route('reports.general.branch')

                        or
                        Request::url() === route('reports.general.ledger.type')

                        or
                        Request::url() === route('reports.general.bank_cash')

                        or
                        Request::url() === route('reports.general.voucher')



                     )
                            class="active "
                                @endif


                        >


                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>General</span>
                            </a>

                            <ul class="ml-menu">
                                <li @if( config('role_manage.GeneralBranch.All')==0 )
                                    class="dis-none"
                                    @endif

                                    @if(Request::url() === route('reports.general.branch'))
                                    class="active "
                                        @endif >
                                    <a href="{{ route('reports.general.branch') }}">Branch</a>
                                </li>

                                <li @if( config('role_manage.GeneralLedger.All')==0 )
                                    class="dis-none"
                                    @endif

                                    @if(Request::url() === route('reports.general.ledger.type'))
                                    class="active "
                                        @endif >
                                    <a href="{{ route('reports.general.ledger.type') }}">Ledger</a>
                                </li>

                                <li @if( config('role_manage.GeneralBankCash.All')==0 )
                                    class="dis-none"
                                    @endif

                                    @if(Request::url() === route('reports.general.bank_cash'))
                                    class="active "
                                        @endif >
                                    <a href="{{ route('reports.general.bank_cash') }}">Bank Cash</a>
                                </li>

                                <li
                                        @if( config('role_manage.GeneralVoucher.All')==0 )
                                        class="dis-none"
                                        @endif

                                        @if(Request::url() === route('reports.general.voucher'))
                                        class="active "
                                        @endif >
                                    <a href="{{ route('reports.general.voucher') }}">Voucher</a>
                                </li>


                            </ul>

                        </li>
                        {{--General Report End--}}

                    </ul>
                </li>

 
                {{--Report End--}}

                {{-- Department department Start --}}

                <li @if ( config('role_manage.Department.All')==0 and  config('role_manage.Department.TrashShow')==0 and config('role_manage.Department.Create')==0  )
                    class="dis-block"
                    @endif  @if(Request::url() === route('department') or Request::url() === route('department.create') or Request::url() === route('department.trashed') or Request::url() === route('department.active.search') or Request::url() === route('department.trashed.search') )
                    class="active "
                        @endif >
                    <a class="" @if (config('role_manage.Department.All')==0)
                               class="dis-block"
                               @endif href="{{ route('department') }}">
                        <i class="fas fa-building"></i>
                        <span>Department</span>
                    </a>

                </li>

                {{-- Department stop --}} 

                {{--User Start--}}
                <li @if ( config('role_manage.User.All')==0 and  config('role_manage.User.TrashShow')==0 and config('role_manage.User.Create')==0  )
                    class="dis-none"
                    @endif  @if(Request::url() === route('user') or Request::url() === route('user.create') or Request::url() === route('user.trashed') or Request::url() === route('user.active.search') or Request::url() === route('user.trashed.search') )
                    class="active "
                        @endif >
                    <a class="" @if (config('role_manage.User.All')==0)
                               class="dis-none"
                               @endif href="{{ route('user') }}">
                        <i class="fas fa-user"></i>
                        <span>User</span>
                    </a>

                </li>

                {{--User End--}}

                


                

                {{--role-manage Start--}}
                <li @if(Request::url() === route('role-manage') or Request::url() === route('role-manage.create') or Request::url() === route('role-manage.trashed') or Request::url() === route('role-manage.active.search') or Request::url() === route('role-manage.trashed.search') )
                    class="active"
                    @endif @if ( config('role_manage.RoleManager.All')==0 and  config('role_manage.RoleManager.TrashShow')==0 and config('role_manage.RoleManager.Create')==0 )
                    class="dis-none"
                        @endif>
                    <a class="" @if (config('role_manage.RoleManager.All')==0)
                                    class="dis-none"
                                    @endif href="{{ route('role-manage') }}">
                        <i class="fas fa-user-lock "></i>
                        <span>Role Manage</span>
                    </a>
                </li>
                {{--role-manage End--}}

                {{--SETTINGSStart--}}
                <li @if(Request::url() === route('settings.system')
                    or Request::url() === route('settings.general')
                 )
                    class="active"
                    @endif
                    @if( config('role_manage.Settings.All') ==0 and config('role_manage.Settings.Show') ==0 )

                    class="dis-none"

                        @endif >
                    <!-- <a class="menu-toggle " href="javascript:void(0);">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a> -->
                    <a href="{{ route('settings.general')  }}">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                    <!-- <ul class="ml-menu">


                        <li @if ( config('role_manage.Settings.All') ==0 )
                            class="dis-none"
                            @endif

                            @if(Request::url() === route('settings.general'))
                            class="active"
                                @endif >
                            <a href="{{ route('settings.general')  }}"> General </a>
                        </li>


                        <li @if ( config('role_manage.Settings.Show') ==0 )
                            class="dis-none"
                            @endif
                            @if(Request::url() === route('settings.system'))
                            class="active"
                                @endif >
                            <a href="{{ route('settings.system')  }}">System</a>
                        </li>
                    </ul> -->
                </li>
                {{--SETTINGS End--}}

            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <!-- <div class="legal">
            <div class="copyright">
               {{ config('settings.developed_label') }}  <a target="_blank" href="{{ config('settings.developed_link') }}">{{ config('settings.developed_by') }}</a>
            </div>
            <div class="version">
                <b>Version: </b> {{ config('settings.version') }}
            </div>
        </div> -->
        <!-- #Footer -->
    </aside>
</section>