<?php

namespace Onboardr\Http\Middleware;

use Closure;
use Onboardr\Organizations\OrganizationRepository;

class Member
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
        $org = $this->orgRepo->find($request->route()->parameters()['organization']);

        foreach($org->users as $user) {
            if ($user->id == \Auth::user()->id) {
                return $next($request);
            }
        }

        return redirect("/app/");
    }
}
