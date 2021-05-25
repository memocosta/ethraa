<?php include 'header.php' ?>

<div role="main" class="main">
    <section class="page-header page-header-color page-header-quaternary page-header-more-padding custom-page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 center">
                    <p class="custom-text-color-1">أطلع على مزيد من خدماتنا عن طريق منصة <a href="https://www.itqan-kw.com/"> اتقان </a></p>
                    <p><a href="https://www.itqan-kw.com/">
                            <img src="img/itqan.png" class="img-responsive itqan" alt />
                        </a></p>
                </div>
                <div class="col-md-6">
                    <h1> خدماتنا </h1>
                    <br><br>
                    <h2 class="custom-text-color-1">حساب المستحقات العماليه</h2>
                </div>
            </div>
        </div>
    </section>

    <div class="container">

        <div class="row pt-sm mb-xl">

            <div class="col-md-12 form-work">

                <h2 class="mb-sm">حساب المستحقات العماليه</h2>

                <p class="mb-xl mt-lg">ادخل البيانات ادناه لحساب مستحقات العمال</p>

                <form id="calc-worker" method="POST">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6 mb-2">
                                <label>اسم العامل *</label>
                                <input type="text" maxlength="100" class="form-control user-info-name" name="name" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>اسم الشركة *</label>
                                <input type="text" maxlength="100" class="form-control user-info-company" name="company" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>الوظيفة *</label>
                                <input type="text" maxlength="100" class="form-control user-info-job" name="job" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>الراتب الشهرى *</label>
                                <input type="number" min="0" class="form-control calc" name="salery" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>ما يضاف الى الراتب *</label>
                                <input type="number" min="0" class="form-control calc" name="saleryPlus" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>ساعات العمل *</label>
                                <input type="text" maxlength="100" class="form-control user-info-hours calc" name="workHours" required>
                            </div>
                            <div class="col-md-6 mb-2 start-work">
                                <label>بداية العمل بالشركة *</label>
                                <input type="text" class="form-control user-info-startWork calc" name="startWork" id="start-work" required>
                            </div>
                            <div class="col-md-6 mb-2 end-work">
                                <label>نهاية العمل بالشركة *</label>
                                <input type="text" class="form-control user-info-endWork calc" name="endWork" id="end-work" required>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label>فى حالة أعطاء العامل ميزة افضل باحتساب رصيد الاجازات للعام الواحد *</label>
                                <input type="number" min="30" max="60" value="30" class="form-control user-info-additionVacation calc" name="additionVacation" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>سبب نهاية الخدمة *</label>
                                <select class="form-control calc" name="endReason" require>
                                    <option value="1">يعود للمدعى</option>
                                    <option value="2">يعود للمدعى عليه</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>ايام تخصم من مكافاة نهاية الخدمة </label>
                                <input type="number" min="0" class="form-control user-info-discountDaysFromEnd calc" name="discountDaysFromEnd" placeholder="أيام">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label> يخصم ايام قبل 20-2-2010 </label>
                                <input type="number" min="0" class="form-control user-info-discountDaysBefore20 calc" name="discountDaysBefore20" placeholder="أيام">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label> يخصم ايام بعد 20-2-2010 </label>
                                <input type="number" min="0" class="form-control user-info-discountDaysAfter20 calc" name="discountDaysAfter20" placeholder="أيام">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label> ايام اجازة مدفوعة الاجر </label>
                                <input type="number" min="0" class="form-control user-info-vacationDaysPaid calc" name="vacationDaysPaid" placeholder="أيام">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label> خصم التامينات للكويتيين</label>
                                <input type="number" min="0" value="" maxlength="100" class="form-control calc" name="discountInsurance">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>
                                    بدل فترة انزار
                                    <i class="fa fa-info-circle" data-plugin-tooltip data-toggle="tooltip" data-placement="bottom" title="مادة 44 اذا كان عقد العمل غير محدد المدة جاز لكل من طرفية انهاؤه بعد اخطار الطرف الاخر ويكون الاخطار على الوجه الاتى أ/ قبل انهاء العقد بثلاثة اشهر على الأقل بالنسبة للعمال المعينين باجر شهري. ب/ قبل لنتهاء العقد بشهر على الأقل بالنسبة للعمال الاخرين فاذا لم يراع الطرف الذي انهى العقد مدة الاخطار فانه يلتزم بان يدفع للطرف الاخر بدل مهلة الاخطار مساوية لاجر العامل عن نفس المدة لصاحب العمل ان يعفى العامل عن العمل اثناء مهلة الاخطار مع احتساب مدة خدمة العامل مستمرة الى حين انتهاء تلك المهلة مع ما يترتب علي ذالك من اثار وبخاصة استحقاق العامل اجره عن مهلة الاخطار"></i>
                                </label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control calc" name="noticePeriodMonths" placeholder="شهور">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control calc" name="noticePeriodDays" placeholder="أيام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>
                                    اجور متاخرة
                                    <i class="fa fa-info-circle" data-plugin-tooltip data-toggle="tooltip" data-placement="bottom" title="مادة 55 يقصد بالاجر مايتقاضاه العامل من اجر أساسي مضافا الية ما يتقاضاه عادة من علاوات ومكافات او عمولات او منح او هبات دورية او مزايا نقدية واذا حدد الاجر بمقدار حصة من صافى الأرباح ولم تحقق المنشاة ربحا او حققت ربحا ضئيلا بحيث لا تتناسب حصة العامل مع العمل الذى قام به يجب تقدير اجرة المثل او وفقا لعرف   المهنة او لمقتضيات العدالة - ويراعي في احتساب الاجر اخر اجر تقاضاه العامل 2 مادة 62 الاجر الذى يعول علية عند حساب ما يستحقه العامل من مكافاة نهاية الخدمة هو اخر اجر تقاضاه ويدخل فية كل ما يعطى للعامل مقابل العمل الذى يؤدية متى اخذ شكل الاعتياد فاذا كان العامل ممن يتقاضون اجورهم بالقطعة يحدد اجره بمتوسط ما تقاضاه خلال ايام العمل الفعلية في الاشهر الثلاثة الاخيرة ويكون تقدير المزايا النقدية والعينية بتقييم متوسط ماتقاضاه العامل منها خلال الاثنى عشر شهرا الاخيرة على الاستحقاق فاذا قلت مدة خدمتة عن سنة حسب المتوسط على نسبة ما امضاه منها في الخدمة ولا يجوز تخفيض اجر العامل خلال مدة عقده لاى سشبب من الاسباب (مادة 28 )  "></i>
                                </label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control calc" name="delaySaleryMonths" placeholder="شهور">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control calc" name="delaySaleryDays" placeholder="أيام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>
                                    بدل الراحة الاسبوعية
                                    <i class="fa fa-info-circle" data-plugin-tooltip data-toggle="tooltip" data-placement="bottom" title="مادة 67 للعامل الحق في راحة أسبوعية مدفوعة الاجر ويجوز تشغيل العامل يوم راحتة الأسبوعية ويتقاضى 50؟% على الأقل من اجره إضافة لاجره الأصلي ويعوض راحتة بيوم راحة اخر ولا يخل حكم الفقرة السابقة في حساب حق العامل بما فيها اجره اليومي واجازاته حيث يجري حساب هذا الحق بقسمة راتبة علي عدد ايام العمل الفعلية دون ان يحسب من ضمنها ايام راحته الاسبوعية على الرغم من كون ايام الراحة هذه مدفوعة الاجر"></i>
                                </label>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="number" min="0" class="form-control calc" name="weeklyRest" placeholder="أيام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>
                                    بدل ساعات العمل الاضافية
                                    <i class="fa fa-info-circle" data-plugin-tooltip data-toggle="tooltip" data-placement="bottom" title="مادة 66 يحق للعامل ان يحصل علي اجر عن فترة العمل الإضافي يزيد علي اجره العادى في الفترة المماثلة بمقدار 25%"></i>
                                </label>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="number" min="0" class="form-control calc" name="additionHours" placeholder="ساعات">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>
                                    بدل الأعياد والعطل الرسمية
                                    <i class="fa fa-info-circle" data-plugin-tooltip data-toggle="tooltip" data-placement="bottom" title="مادة 68 الاجازات الرسمية المقررة للعامل باجر كامل هي ا-يوم راس السنة الهجرية يوم واحد ب-يوم الاسراء والمعراج يوم واحد ج-عيد الفطر ثلاثة أيام د-وقفة عيد الأضحى يوم واحد ه-عيد الأضحى المبارك ثلاثة أيام و-المولد النبوى الشريف يوم واحد ز- العيد الوطني يوم واحد ح- يوم التحرير يوم واحد ط-راس السنة الميلادية يوم واحد اذا جرى تشغيل العامل فى احد هذه الايام قرر له اجر مضاعف عنه مع تعويضه بيوم بديل "></i>
                                </label>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="number" min="0" class="form-control calc" name="daysForVacation" placeholder="ايام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>
                                    بدل اعياد تصادف راحة اسبوعية
                                    <i class="fa fa-info-circle" data-plugin-tooltip data-toggle="tooltip" data-placement="bottom" title="مادة 68 الاجازات الرسمية المقررة للعامل باجر كامل هي ا-يوم راس السنة الهجرية يوم واحد ب-يوم الاسراء والمعراج يوم واحد ج-عيد الفطر ثلاثة أيام د-وقفة عيد الأضحى يوم واحد ه-عيد الأضحى المبارك ثلاثة أيام و-المولد النبوى الشريف يوم واحد ز- العيد الوطني يوم واحد ح- يوم التحرير يوم واحد ط-راس السنة الميلادية يوم واحد اذا جرى تشغيل العامل فى احد هذه الايام قرر له اجر مضاعف عنه مع تعويضه بيوم بديل"></i>
                                </label>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="number" min="0" class="form-control calc" name="daysForVacation2" placeholder="ايام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>
                                    اجمالى أيام المرضى
                                    <i class="fa fa-info-circle" data-plugin-tooltip data-toggle="tooltip" data-placement="bottom" title="مادة 69 للعامل الحق في الاجازات المرضية الاتية خلال السنة اذا اثبت المرض بشهادة من الطبيب الذى يعينة صاحب العمل او الطبيب المسئول في الوحدة الصحية الحكومية ويعتد بالشهادة الأخيرة في حالة وقوع خلاف بيب الشادتين 1 - خمسة عشر يوما باجر كامل 2 - عشر أيام بثلاثة ارباع الاجر 3 - عشر ايام بنصف الاجر 4 - عشر ايام بربع الاجر 5 - ثلاثون يوما بدون اجر"></i>
                                </label>
                                <input type="number" min="0" max="45" class="form-control calc" name="sickDays">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>
                                    أجور مدة العلاج - بالاجر كامل
                                    <i class="fa fa-info-circle" data-plugin-tooltip data-toggle="tooltip" data-placement="bottom" title="مادة 93 للعامل المصاب بإصابة عمل او مرض مهني الحق في تقاضي اجره طوال فترة العلاج التي يحددها الطبيب واذا زادت فترة العلاج على ستة اشهر يدفع له نصف الاجر فقط حتى شفاؤه او تثبت عاهتة او يتوفي"></i>
                                </label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control calc" placeholder="شهور" name="treatmentFeesMonthes">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control calc" placeholder="أيام" name="treatmentFeesDays">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label>
                                    أجور مدة العلاج - بنصف الاجر
                                    <i class="fa fa-info-circle" data-plugin-tooltip data-toggle="tooltip" data-placement="bottom" title="مادة 93 للعامل المصاب بإصابة عمل او مرض مهني الحق في تقاضي اجره طوال فترة العلاج التي يحددها الطبيب واذا زادت فترة العلاج على ستة اشهر يدفع له نصف الاجر فقط حتى شفاؤه او تثبت عاهتة او يتوفي"></i>
                                </label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control calc" placeholder="شهور" name="treatmentFeesHalfMonthes">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control calc" placeholder="أيام" name="treatmentFeesHalfDays">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>
                                    تعويض عن إصابة العمل (في حالة الوفاة)
                                    <i class="fa fa-info-circle" data-plugin-tooltip data-toggle="tooltip" data-placement="bottom" title="مادة 94 للعامل المصاب او المستحقين عنه الحق في التعويض عن إصابة العمل او امراض المهنة طبقا للجدول الذى يصدر بقرار من الوزير ولم يصدر بعد هذا القرار ويعمل بقرار وزير الشئون الاجتماعية والعمل رقم 1998/120 والذى جاء قيد يكون التعويض للعامل في حالة الوفاة هو اجر كامل عن 1500 يوم او قيمة الدية الشرعية ايهما اكبر وتزداد نسبة التعويض في حالة العجز الدائم الكلي الي اجر كامل عن 2000 يوما او ما يعادل مرة وثلث الدية الشرعية ايهما اكبر اما في حالة العجز الجزئى الدائم فيحتسب التعويض عنه بما يعادل النسبة المقررة لذلك العجز من قيمة التعويض عن العجز الكلي الدائم"></i>
                                </label>
                                <input type="number" min="0" class="form-control calc" name="workInjuryDays" placeholder="أيام">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>
                                    العجز الدائم الكلى
                                    <i class="fa fa-info-circle" data-plugin-tooltip data-toggle="tooltip" data-placement="bottom" title="مادة 93 للعامل المصاب بإصابة عمل او مرض مهني الحق في تقاضي اجره طوال فترة العلاج التي يحددها الطبيب واذا زادت فترة العلاج على ستة اشهر يدفع لة نصف الاجر فقط حتى شفاؤه او تثبت عاهته او يتوفى"></i>
                                </label>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="number" min="0" class="form-control calc" name="TotalDisability" placeholder="ايام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>
                                    العجز الجزئى
                                    <i class="fa fa-info-circle" data-plugin-tooltip data-toggle="tooltip" data-placement="bottom" title="مادة 93 للعامل المصاب بإصابة عمل او مرض مهني الحق في تقاضي اجره طوال فترة العلاج التي يحددها الطبيب واذا زادت فترة العلاج على ستة اشهر يدفع لة نصف الاجر فقط حتى شفاؤه او تثبت عاهته او يتوفى"></i>
                                </label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control calc" name="precentDisability" placeholder="النسبة %">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control calc" name="partialDisability" placeholder="ايام">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label>
                                    مستحقات إجازة الوضع
                                    <i class="fa fa-info-circle" data-plugin-tooltip data-toggle="tooltip" data-placement="bottom" title="مادة 1/24 تستحق المراة العاملة الحامل إجازة مدفوعة الاجر لاتحسب من اجازتها الأخرى لمدة سبعين يوما للوضع بشرط ان يتم الوضع خلالها"></i>
                                </label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control calc" name="maternityLeaveMonths" placeholder="شهور">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control calc" name="maternityLeaveDays" placeholder="أيام">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label>
                                    مستحقات إجازة عدة
                                    <i class="fa fa-info-circle" data-plugin-tooltip data-toggle="tooltip" data-placement="bottom" title="مادة 3.2/77 للمراة العاملة المسلمة التي يتوفي زوجها الحق في إجازة عدة باجر كامل لمدة أربعة اشهر وعشرة أيام من تاريخ الوفاة كما تمنح المراة العاملة غير المسلمة المتوفي عنها زوجها إجازة لمدة واحد وعشرون يوما مدفوعة الاجر"></i>
                                </label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control calc" name="maternityLeaveMonths2" placeholder="شهور">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control calc" name="maternityLeaveDays2" placeholder="أيام">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" value="حساب المستحقات" class="btn btn-primary btn-block mb-xlg">
                        </div>
                    </div>
                </form>

            </div>

            <div class="col-md-12 form-result">

                <div class="page0">
                    <div id="v4" class="benfits-nonprint"></div>
                    <input id="cli" type="button" value="تحويل الجدول الى صورة" class="btn btn-primary btn-block mb-xlg benfits-nonprint">
                    <div class="table-responsive userInfo pd-15">
                        <table id="t1" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print">اسم العامل</td>
                                <td class="user-name"></td>
                                <td class="red-print">الراتب الشهرى</td>
                                <td class="user-salary"></td>
                            </tr>
                            <tr>
                                <td class="red-print">اسم الشركة</td>
                                <td class="user-company"></td>
                                <td class="red-print">ما يضاف الى الراتب</td>
                                <td class="user-salary-plus"></td>
                            </tr>
                            <tr>
                                <td class="red-print">الوظيفة</td>
                                <td class="user-job"></td>
                                <td class="red-print">تاريخ بداية العمل</td>
                                <td class="startWork"></td>
                            </tr>
                            <tr>
                                <td class="red-print">ساعات العمل</td>
                                <td class="user-hours"></td>
                                <td class="red-print">تاريخ نهاية العمل</td>
                                <td class="endWork"></td>

                            </tr>
                        </table>
                        <table id="t2" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print">فى حالة أعطاء العامل ميزة افضل باحتساب رصيد الاجازات للعام الواحد</td>
                                <td class="additionVacation"></td>
                            </tr>
                        </table>
                        <table id="t3" class="table table-bordered table-striped table-hover dmy">
                            <tr>
                                <td></td>
                                <td class="red-print">يوم</td>
                                <td class="red-print">شهر</td>
                                <td class="red-print">سنة</td>
                            </tr>
                            <tr style="display: none;">
                                <td class="red-print">ايام تخصم من مكافاة نهاية الخدمة</td>
                                <td class="discountDaysFromEnd"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr style="display: none;">
                                <td class="red-print">يخصم ايام قبل 20-2-2010</td>
                                <td class="discountDaysBefore20"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr style="display: none;">
                                <td class="red-print">يخصم ايام بعد 20-2-2010</td>
                                <td class="discountDaysAfter20"></td>
                                <td></td>
                                <td></td>

                            </tr>
                            <tr style="display: none;">
                                <td class="red-print">ايام اجازة مدفوعة الاجر</td>
                                <td class="vacationDaysPaid"></td>
                                <td></td>
                                <td></td>

                            </tr>
                        </table>
                    </div>
                </div>

                <div class="page1">
                    <div class="table-responsive pd-15">
                        <table id="t4" class="table table-bordered table-striped table-hover">
                            <thead class="thead-inverse ">
                                <tr>
                                    <th class="red-print">المستحقات</th>
                                    <th class="red-print">الاجمالى</th>
                                </tr>
                            </thead>
                            <tbody class="receivables"></tbody>
                        </table>
                    </div>
                </div>

                <div class="page2">
                    <div class="table-responsive endDateAwardRes">
                        <h2>حساب مكافاة نهاية الخدمة</h2>
                        <br>
                        <table id="t5" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print">اجمالى مدة الخدمة</td>
                                <td class="red-print">يوم</td>
                                <td class="red-print">شهر</td>
                                <td class="red-print">سنة</td>
                            </tr>
                            <tr>
                                <td class="red-print">نهاية العمل</td>
                                <td class="end-d"></td>
                                <td class="end-m"></td>
                                <td class="end-y"></td>
                            </tr>
                            <tr>
                                <td class="red-print">بداية العمل</td>
                                <td class="start-d"></td>
                                <td class="start-m"></td>
                                <td class="start-y"></td>
                            </tr>
                            <tr>
                                <td class="red-print">يخصم منها الايام التالية</td>
                                <td class="discount-d"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print"> مدة الخدمة الفعلية</td>
                                <td class="work-d"></td>
                                <td class="work-m"></td>
                                <td class="work-date-y"></td>
                            </tr>
                        </table>

                        <table id="t6" class="table table-bordered table-striped table-hover">
                            <tbody id="endDateAwardRes-calc"></tbody>
                        </table>

                        <br>
                        <h2 class="finalAward red-print"></h2>
                        <br>
                        <h2 class="reason red-print"></h2>
                        <br>
                        <h2 class="finalAmount red-print"></h2>
                    </div>
                </div>

                <div class="page3">
                    <div class="table-responsive calcLawDateRes-before">
                        <h2 class="head-title"> حساب رصيد الاجازات على القانون القديم</h2>
                        <br>
                        <table id="t7" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print">اجمالى مدة الخدمة</td>
                                <td class="red-print">يوم</td>
                                <td class="red-print">شهر</td>
                                <td class="red-print">سنة</td>
                            </tr>
                            <tr>
                                <td class="red-print">نهاية العمل</td>
                                <td class="end-d"></td>
                                <td class="end-m"></td>
                                <td class="end-y"></td>
                            </tr>
                            <tr>
                                <td class="red-print">بداية العمل</td>
                                <td class="start-d"></td>
                                <td class="start-m"></td>
                                <td class="start-y"></td>
                            </tr>
                            <tr>
                                <td class="red-print">يخصم منها الايام التالية</td>
                                <td class="before-discount-d"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print"> مدة الخدمة الفعلية</td>
                                <td class="work-d"></td>
                                <td class="work-m"></td>
                                <td class="work-y"></td>
                            </tr>
                        </table>

                        <table id="t8" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print">عن السنوات</td>
                                <td class="work-y"></td>
                                <td>x</td>
                                <td>14</td>
                                <td>=</td>
                                <td class="in-y"></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الاشهر</td>
                                <td><span class="work-m"></span>
                                    <hr> 12
                                </td>
                                <td>x</td>
                                <td>14</td>
                                <td>=</td>
                                <td class="in-m"></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الايام</td>
                                <td><span class="work-d"></span>
                                    <hr> 365
                                </td>
                                <td>x</td>
                                <td>14</td>
                                <td>=</td>
                                <td class="in-d"></td>
                            </tr>
                            <tr>
                                <td class="red-print">عدد الايام طبقا للقانون القديم</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="in-t"></td>
                            </tr>
                        </table>
                    </div>

                    <div class="table-responsive calcLawDateRes-after">
                        <h2 class="head-title"> حساب رصيد الاجازات على القانون الجديد</h2>
                        <br>
                        <table id="t9" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print">اجمالى مدة الخدمة</td>
                                <td class="red-print">يوم</td>
                                <td class="red-print">شهر</td>
                                <td class="red-print">سنة</td>
                            </tr>
                            <tr>
                                <td class="red-print">نهاية العمل</td>
                                <td class="end-d"></td>
                                <td class="end-m"></td>
                                <td class="end-y"></td>
                            </tr>
                            <tr>
                                <td class="red-print">بداية العمل</td>
                                <td class="start-d"></td>
                                <td class="start-m"></td>
                                <td class="start-y"></td>
                            </tr>
                            <tr>
                                <td class="red-print">يخصم منها الايام التالية</td>
                                <td class="after-discount-d"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print"> مدة الخدمة الفعلية</td>
                                <td class="work-d"></td>
                                <td class="work-m"></td>
                                <td class="work-y"></td>
                            </tr>
                        </table>

                        <table id="t10" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print">عن السنوات</td>
                                <td class="work-y"></td>
                                <td>x</td>
                                <td>30</td>
                                <td>=</td>
                                <td class="in-y"></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الاشهر</td>
                                <td><span class="work-m"></span>
                                    <hr> 12
                                </td>
                                <td>x</td>
                                <td>30</td>
                                <td>=</td>
                                <td class="in-m"></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الايام</td>
                                <td><span class="work-d"></span>
                                    <hr> 365
                                </td>
                                <td>x</td>
                                <td>30</td>
                                <td>=</td>
                                <td class="in-d"></td>
                            </tr>
                            <tr>
                                <td class="red-print">عدد الايام طبقا للقانون الجديد</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="in-t"></td>
                            </tr>
                        </table>
                    </div>

                    <div class="table-responsive calcLawDateRes">
                        <table id="t11" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="totalVacationDays red-print"><span class="title"></span></td>
                                <td class="onlyTotalVacationDaysWithOutPaidDays red-print"><span class="title"></span></td>
                                <td class="moneyForAnnualVacation red-print">رصيد الاجازات</td>
                            </tr>
                            <tr>
                                <td class="totalVacationDays"><span class="total"></span></td>
                                <td class="onlyTotalVacationDaysWithOutPaidDays"><span class="total"></span></td>
                                <td class="onlyTotalVacationDaysWithOutPaidDays"><span class="valt"></span></td>
                            </tr>
                        </table>
                        <table id="t12" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="moneyForAnnualVacation red-print"><span class="title">رصيد الاجازات</span></td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>x</td>
                                <td class="onlyTotalVacationDaysWithOutPaidDays"><span class="valt"></span></td>
                                <td>=</td>
                                <td class="moneyForAnnualVacation"><span class="total"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="page4">
                    <br><br>
                    <div class="table-responsive noticePeriodDays">
                        <table id="t13" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print"><strong>بدل فترة انزار</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأشهر</td>
                                <td class="work-s"></td>
                                <td>x</td>
                                <td class="notice-month"></td>
                                <td>=</td>
                                <td class="notice-month-res"></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأيام</td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>x</td>
                                <td class="notice-days"></td>
                                <td>=</td>
                                <td class="notice-days-res"></td>
                            </tr>
                        </table>
                        <table id="t15" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td>اجمالى المستحق عن فترة الانزار</td>
                                <td class="notice-res"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="table-responsive delaySaleryDays">
                        <hr><br>
                        <table id="t14" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print"><strong>المستحق من الاجور المتاخرة</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأشهر</td>
                                <td class="work-s"></td>
                                <td>x</td>
                                <td class="delay-month"></td>
                                <td>=</td>
                                <td class="delay-month-res"></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأيام</td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>x</td>
                                <td class="delay-days"></td>
                                <td>=</td>
                                <td class="delay-days-res"></td>
                            </tr>
                        </table>
                        <table id="t15" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td>اجمالى المستحق من الاجور المتاخرة</td>
                                <td class="delay-res"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="table-responsive weeklyRestRes">
                        <hr><br>
                        <table id="t16" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print"><strong>المستحق عن بدل الراحة الاسبوعية</strong></td>
                                <td class="weeklyRest-res"></td>
                            </tr>
                        </table>
                        <table id="t17" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print">عن الأيام</td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>x</td>
                                <td class="weeklyRest-days"></td>
                                <td>x</td>
                                <td>150%</td>
                                <td>=</td>
                                <td class="weeklyRest-res"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="table-responsive additionHoursRes">
                        <hr><br>
                        <table id="t18" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print"><strong>المستحق عن بدل ساعات العمل الاضافى</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print">أجر الساعة</td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>÷</td>
                                <td class="work-hours"></td>
                                <td></td>
                                <td>=</td>
                                <td></td>
                                <td class="hour-rate"></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الساعات</td>
                                <td class="hour-rate"></td>
                                <td>x</td>
                                <td class="add-hours"></td>
                                <td>x</td>
                                <td>125%</td>
                                <td>=</td>
                                <td class="addHour-res"></td>
                            </tr>
                        </table>
                        <table id="t19" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td>اجمالى المستحق عن بدل ساعات العمل الاضافى</td>
                                <td class="addHour-res"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="table-responsive daysForVacation">
                        <hr><br>
                        <table id="t20" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print"><strong>المستحق عن بدل الاعياد والعطل الرسمية</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأيام</td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>x</td>
                                <td class="daysvac-days"></td>
                                <td>=</td>
                                <td class="daysvac-res"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="table-responsive daysForVacation2">
                        <hr><br>
                        <table id="t21" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print"><strong>المستحق عن بدل الاعياد التى تصادف راحة اسبوعية</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأيام</td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>x</td>
                                <td class="daysvac2-days"></td>
                                <td>x</td>
                                <td>200%</td>
                                <td>=</td>
                                <td class="daysvac2-res"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="page5">
                    <div class="table-responsive sickdays">
                        <table id="t22" class="table table-bordered table-striped table-hover sick100">
                            <tr>
                                <td class="red-print"><strong>المستحق عن الأيام المرضى باجر كامل</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأيام</td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>x</td>
                                <td class="sick100-days"></td>
                                <td>x</td>
                                <td>100%</td>
                                <td>=</td>
                                <td class="sick100-res"></td>
                            </tr>
                        </table>
                        <table id="t23" class="table table-bordered table-striped table-hover sick75">
                            <tr>
                                <td class="red-print"><strong>المستحق عن الأيام المرضى بثلاثة ارباع الاجر</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأيام</td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>x</td>
                                <td class="sick75-days"></td>
                                <td>x</td>
                                <td>75%</td>
                                <td>=</td>
                                <td class="sick75-res"></td>
                            </tr>
                        </table>
                        <table id="t24" class="table table-bordered table-striped table-hover sick50">
                            <tr>
                                <td class="red-print"><strong>المستحق عن الأيام المرضى بنصف الاجر</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأيام</td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>x</td>
                                <td class="sick50-days"></td>
                                <td>x</td>
                                <td>50%</td>
                                <td>=</td>
                                <td class="sick50-res"></td>
                            </tr>
                        </table>
                        <table id="t25" class="table table-bordered table-striped table-hover sick25">
                            <tr>
                                <td class="red-print"><strong>المستحق عن الأيام المرضى بربع الاجر</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأيام</td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>x</td>
                                <td class="sick25-days"></td>
                                <td>x</td>
                                <td>25%</td>
                                <td>=</td>
                                <td class="sick25-res"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="table-responsive treatmentFeesFull">
                        <hr><br>
                        <table id="t26" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print"><strong>المستحق عن إصابة العمل بالاجر الكامل</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأشهر</td>
                                <td class="work-s"></td>
                                <td>x</td>
                                <td class="full-month"></td>
                                <td>x</td>
                                <td>100%</td>
                                <td>=</td>
                                <td class="full-month-res"></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأيام</td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>x</td>
                                <td class="full-days"></td>
                                <td>x</td>
                                <td>100%</td>
                                <td>=</td>
                                <td class="full-days-res"></td>
                            </tr>
                        </table>
                        <table id="t27" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td>اجمالى المستحق عن إصابة العمل بالاجر الكامل</td>
                                <td class="full-res"></td>
                            </tr>
                        </table>
                        <table id="t28" class="table table-bordered table-striped table-hover treatmentFeesHalf">
                            <tr>
                                <td class="red-print"><strong>المستحق عن إصابة العمل بنصف الاجر</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأشهر</td>
                                <td class="work-s"></td>
                                <td>x</td>
                                <td class="half-month"></td>
                                <td>x</td>
                                <td>50%</td>
                                <td>=</td>
                                <td class="half-month-res"></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأيام</td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>x</td>
                                <td class="half-days"></td>
                                <td>x</td>
                                <td>50%</td>
                                <td>=</td>
                                <td class="half-days-res"></td>
                            </tr>
                        </table>
                        <table id="t29" class="table table-bordered table-striped table-hover treatmentFeesHalf">
                            <tr>
                                <td>اجمالى المستحق عن إصابة العمل بالاجر الكامل</td>
                                <td class="half-res"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="page6">
                    <div class="table-responsive">
                        <table id="t30" class="table table-bordered table-striped table-hover inCaseDead">
                            <tr>
                                <td class="red-print"><strong>المستحق عن إصابة العمل في حالة الوفاه</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأيام</td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>x</td>
                                <td class="dead-days"></td>
                                <td>=</td>
                                <td class="dead-days-res"></td>
                            </tr>
                        </table>
                        <table id="t31" class="table table-bordered table-striped table-hover inCaseDead">
                            <tr>
                                <td>قيمة الدية الشرعية</td>
                                <td>10000</td>
                            </tr>
                            <tr>
                                <td>اجمالى المستحق عن إصابة العمل في حالة الوفاه</td>
                                <td class="dead-res"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="table-responsive totalDisability">
                        <hr><br>
                        <table id="t32" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print"><strong>العجز الدائم الكلى</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأيام</td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>x</td>
                                <td class="totalDisable-days"></td>
                                <td>=</td>
                                <td class="totalDisable-days-res"></td>
                            </tr>
                        </table>
                        <table id="t33" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td>قيمة الدية الشرعية</td>
                                <td>13333.33</td>
                            </tr>
                            <tr>
                                <td>اجمالى المستحق عن العجز الدائم الكلى</td>
                                <td class="totalDisable-res"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="table-responsive partDisability">
                        <hr><br>
                        <table id="t34" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print"><strong>العجز الدائم الجزئى</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأيام</td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>x</td>
                                <td class="partDisable-days"></td>
                                <td>x</td>
                                <td><span class="partDisable-percent"></span>%</td>
                                <td>=</td>
                                <td class="partDisable-days-res"></td>
                            </tr>
                        </table>
                        <table id="t35" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td>قيمة الدية الشرعية</td>
                                <td class="partDisable-val"></td>
                            </tr>
                            <tr>
                                <td>اجمالى المستحق عن العجز الدائم الجزئى</td>
                                <td class="partDisable-res"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="table-responsive maternity">
                        <hr><br>
                        <table id="t36" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print"><strong>مستحقات إجازة الوضع</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأشهر</td>
                                <td class="work-s"></td>
                                <td>x</td>
                                <td class="maternity-month"></td>
                                <td>=</td>
                                <td class="maternity-month-res"></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأيام</td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>x</td>
                                <td class="maternity-days"></td>
                                <td>=</td>
                                <td class="maternity-days-res"></td>
                            </tr>
                        </table>
                        <table id="t37" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td>اجمالى المستحق إجازة الوضع</td>
                                <td class="maternity-res"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="table-responsive maternity2">
                        <hr><br>
                        <table id="t38" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td class="red-print"><strong>مستحقات إجازة عدة</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأشهر</td>
                                <td class="work-s"></td>
                                <td>x</td>
                                <td class="maternity-month"></td>
                                <td>=</td>
                                <td class="maternity-month-res"></td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الأيام</td>
                                <td><span class="work-s"></span>
                                    <hr> 26
                                </td>
                                <td>x</td>
                                <td class="maternity-days"></td>
                                <td>=</td>
                                <td class="maternity-days-res"></td>
                            </tr>
                        </table>
                        <table id="t39" class="table table-bordered table-striped table-hover">
                            <tr>
                                <td>اجمالى المستحق إجازة عدة</td>
                                <td class="maternity-res"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12 center pt-md benfits-nonprint area-print">
                <input type="button" id="back-form" value="رجوع للبيانات" class="btn btn-primary btn-block mb-xlg">
                <input type="button" id="calc-print" value="طباعة المحتوى" class="btn btn-primary btn-block mb-xlg">
            </div>
        </div>

        <div class="footer-copyright background-color-light m-none pt-md pb-md benfits-nonprint">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 center pt-md">
                        <p class="custom-text-color-1">يتم حساب المستحقات العماليه عن طريق منصة <a href="https://www.itqan-kw.com/"> اتقان </a></p>
                        <p><a href="https://www.itqan-kw.com/">
                                <img src="img/itqan.jpg" class="img-responsive itqan" alt />
                            </a></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <hr class="tall benfits-nonprint">

</div>

<?php include 'footer.php' ?>