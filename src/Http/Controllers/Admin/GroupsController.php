<?php

namespace Vegacms\Cms\Http\Controllers\Admin;

use Vegacms\Cms\Models\Group;
use Vegacms\Cms\Http\Controllers\Controller;
use Vegacms\Cms\Http\Requests\Admin\AdminGroupRequest;
use Vegacms\Cms\Services\Interfaces\GroupServiceInterface;

class GroupsController extends Controller
{
    /**
     * @var GroupServiceInterface
     */
    protected $groupService;

    /**
     * GroupsController constructor.
     * @param GroupServiceInterface $groupService
     */
    public function __construct(GroupServiceInterface $groupService)
    {
        $this->groupService = $groupService;
    }

    /**
     * Admin groups index page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('vegacms::admin.groups.index');
    }

    /**
     * Admin groups show page
     *
     * @param Group $group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Group $group)
    {
        return view('vegacms::admin.groups.show', compact('group'));
    }

    /**
     * Admin groups create page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('vegacms::admin.groups.create');
    }

    /**
     * Admin groups store action
     *
     * @param AdminGroupRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(AdminGroupRequest $request)
    {
        $validationData = $this->groupService->create($request->validated());
        if($validationData === true) {
            $group = Group::where('title', $request->title)->first();

            return redirect()->route('admin-groups.show', $group->getSlug())->with(compact('group'));
        }

        return redirect()->back()->with(['messageData' => $validationData]);

    }

//    /**
//     * Admin groups edit page
//     *
//     * @param Group $group
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function edit(Group $group)
//    {
//        return view('vegacms::admin.groups.edit', compact('group'));
//    }
//
//    /**
//     * Admin groups update action
//     *
//     * @param Group $group
//     * @param AdminGroupRequest $request
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function update(Group $group, AdminGroupRequest $request)
//    {
//        $group->update($request->validated());
//
//        return redirect()->back()->with(compact($group));
//    }
}
