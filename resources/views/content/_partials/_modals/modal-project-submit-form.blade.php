
<div class="modal modal-slide-in sidebar-todo-modal fade" id="project-submit-modal">
    <div class="modal-dialog sidebar-lg">
        <div class="modal-content p-0">
            <form id="form-modal-todo" class="todo-modal needs-validation" novalidate onsubmit="return false">
                <div class="modal-header align-items-center mb-1">
                    <h5 class="modal-title">Add Task</h5>
                    <div class="todo-item-action d-flex align-items-center justify-content-between ms-auto">
            <span class="todo-item-favorite cursor-pointer me-75"
            ><i data-feather="star" class="font-medium-2"></i
                ></span>
                        <i data-feather="x" class="cursor-pointer" data-bs-dismiss="modal" stroke-width="3"></i>
                    </div>
                </div>
                <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                    <div class="action-tags">
                        <div class="mb-1">
                            <label for="todoTitleAdd" class="form-label">Title</label>
                            <input
                                type="text"
                                id="todoTitleAdd"
                                name="todoTitleAdd"
                                class="new-todo-item-title form-control"
                                placeholder="Title"
                            />
                        </div>
                        <div class="mb-1 position-relative">
                            <label for="task-assigned" class="form-label d-block">Assignee</label>
                            <select class="select2 form-select" id="task-assigned" name="task-assigned">
                                <option
                                    data-img="{{asset('images/portrait/small/avatar-s-3.jpg')}}"
                                    value="Phill Buffer"
                                    selected
                                >
                                    Phill Buffer
                                </option>
                                <option data-img="{{asset('images/portrait/small/avatar-s-1.jpg')}}" value="Chandler Bing">
                                    Chandler Bing
                                </option>
                                <option data-img="{{asset('images/portrait/small/avatar-s-4.jpg')}}" value="Ross Geller">
                                    Ross Geller
                                </option>
                                <option data-img="{{asset('images/portrait/small/avatar-s-6.jpg')}}" value="Monica Geller">
                                    Monica Geller
                                </option>
                                <option data-img="{{asset('images/portrait/small/avatar-s-2.jpg')}}" value="Joey Tribbiani">
                                    Joey Tribbiani
                                </option>
                                <option data-img="{{asset('images/portrait/small/avatar-s-11.jpg')}}" value="Rachel Green">
                                    Rachel Green
                                </option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="task-due-date" class="form-label">Due Date</label>
                            <input type="text" class="form-control task-due-date" id="task-due-date" name="task-due-date" />
                        </div>
                        <div class="mb-1">
                            <label for="task-tag" class="form-label d-block">Tag</label>
                            <select class="form-select task-tag" id="task-tag" name="task-tag" multiple="multiple">
                                <option value="Team">Team</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                                <option value="Update">Update</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Description</label>
                            <div id="task-desc" class="border-bottom-0" data-placeholder="Write Your Description"></div>
                            <div class="d-flex justify-content-end desc-toolbar border-top-0">
                <span class="ql-formats me-0">
                  <button class="ql-bold"></button>
                  <button class="ql-italic"></button>
                  <button class="ql-underline"></button>
                  <button class="ql-align"></button>
                  <button class="ql-link"></button>
                </span>
                            </div>
                        </div>
                    </div>
                    <div class="my-1">
                        <button type="submit" class="btn btn-primary d-none add-todo-item me-1">Add</button>
                        <button type="button" class="btn btn-outline-secondary add-todo-item d-none" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary d-none update-btn update-todo-item me-1">Update</button>
                        <button type="button" class="btn btn-outline-danger update-btn d-none" data-bs-dismiss="modal">
                            Delete
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
