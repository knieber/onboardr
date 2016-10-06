<?php

namespace Onboardr\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Onboardr\Organizations\Organization;
use Onboardr\Organizations\OrganizationRepository;

class Manager
{
    /** @var OrganizationRepository */
    private $orgRepo;

    public function __construct(OrganizationRepository $orgRepo)
    {

        $this->orgRepo = $orgRepo;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $org = $this->orgRepo->find($request->route()->parameters()['orgId']);

        foreach($org->users as $user) {
            if ($user->id == \Auth::user()->id && $user->pivot->user_type == 'manager') {
                return $next($request);
            }
        }

        return redirect("/app/");
    }
}
