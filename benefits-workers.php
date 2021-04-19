<?php include 'header.php' ?>

<div role="main" class="main">
    <section
		class="page-header page-header-color page-header-quaternary page-header-more-padding custom-page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>- خدماتنا <span>حساب المستحقات العماليه</span></h1>
				</div>
			</div>
		</div>
	</section>

    <div class="container">

        <div class="row pt-sm mb-xl">
            
            <div class="col-md-9">

                <h2 class="mb-sm">حساب المستحقات العماليه</h2>

                <p class="mb-xl mt-lg">ادخل البيانات ادناه لحساب مستحقات العمال</p>

                <form id="calc-worker" action="" method="POST">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6 mb-2">
                                <label>اسم العامل *</label>
                                <input type="text" value="" maxlength="100" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>اسم الشركة *</label>
                                <input type="text" value="" maxlength="100" class="form-control" name="" id="" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>الوظيفة *</label>
                                <input type="text" value="" maxlength="100" class="form-control" name="" id="" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>الراتب الشهرى *</label>
                                <input type="text" value="" maxlength="100" class="form-control" name="" id="" required>
                            </div>
                            <div class="col-md-6 mb-2">
								<div class="form-control-custom form-control-datepicker-custom">
                                    <label>مايضاف الى الراتب *</label>
                                    <input type="text" value=""  class="form-control" name="" id="" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>ساعات العمل *</label>
                                <input type="text" value="" maxlength="100" class="form-control" name="" id="" required>
                            </div>
                            <div class="col-md-6 mb-2 start-work">
                                <div class="form-control-custom form-control-datepicker-custom">
                                    <label>بداية العمل بالشركة *</label>
                                    <input type="text" value="" class="form-control" name="" id="start-work" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2 end-work">
                                <label>نهاية العمل بالشركة *</label>
                                <input type="text" value="" maxlength="100" class="form-control" name="" id="end-work" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>سبب نهاية الخدمة *</label>
                                <select class="form-control" require>
                                    <option value="يعود للمدعى">يعود للمدعى</option>
                                    <option value="يعود للمدعى عليه">يعود للمدعى عليه</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>ايام تخصم من مكافاة نهاية الخدمة *</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" placeholder="سنوات">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" placeholder="شهور">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" placeholder="أيام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label> يخصم ايام قبل 20-2-2010 *</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" placeholder="سنوات">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" placeholder="شهور">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" placeholder="أيام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label> يخصم ايام بعد 20-2-2010 *</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" placeholder="سنوات">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" placeholder="شهور">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" placeholder="أيام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label> ايام اجازة مدفوعة الاجر *</label>
                                <input type="number" value="" maxlength="100" class="form-control" name="" id="" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>مستحقات مكافاة نهاية الخدمة</label>
                                <div class="row" data-plugin-tooltip data-toggle="tooltip" data-placement="top" title="مادة 51 يستحق العامل مكافاة نهاية الخدمة على الوجه الاتى أ/ اجر عشرة أيام عن كل سنة خدمة من السنوات الخمس الاولي وخمسة عشر يوما عن كل سنة من السنوات التالية بحيث لا تزيد المكافاة على اجر سنة وذلك للعمال الذين يتقاضون اجورهم باليومية او بالاسبوع او بالساعة او بالقطعة ب/ اجر خمسة عشر يوما عن كل سنة من السنوات الخمس الاولي واجر شهر عن كل سنة من السنوات التالية بحيث لا تزيد المكافاة في مجموعها من اجر سنة ونصف وذلك للعمال الذين يتقاضون اجورهم بالشهر. ويستحق العامل مكافاة عن كسور السنة بنسبة ماقضاه منها في العمل مادة 52/د تستحق العاملة مكافاة نهاية الخدمة كاملة اذا انهت العاملة العقد من جانبها بسبب زواجها خلال سنة من تاريخ الزواج مادة 53 يستحق العامل نصف مكافاة نهاية الخدمة اذا قام بانهاء العقد غير محدد المدة من جانبة وكانت مدة خدمتة لا تقل عن ثلاث سنوات ولم تبلغ خمس سنوات فاذا بلغت خدمتة خمس سنولات ولم تبلغ عشر سنوات استحق ثلثي المكافاة واذا بلغت مدة خدمتة عشر سنوات يستحق المكافاة كاملة">
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" placeholder="سنوات">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" placeholder="شهور">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" placeholder="أيام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label> خصم التامينات للكويتيين *</label>
                                <input type="number" value="" maxlength="100" class="form-control" name="" id="" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label> صافى مكافاة نهاية الخدمة *</label>
                                <input type="number" value="" maxlength="100" class="form-control" name="" id="" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label> مستحقات الاجازات السنوية *</label>
                                <input type="number" value="" maxlength="100" class="form-control" name="" id="" required data-plugin-tooltip data-toggle="tooltip" data-placement="top" title="مادة 70 و73 للعامل الحق في إجازة سنوية مدفوعة الاجر مدتها ثلاثون يوما ولا يستحق العامل إجازة عن السنة الاولي الا بعد قضائه تسعة اشهر على الأقل في خدمة صاحب العمل ولا تحتسب ضمن الاجازة السنوية أيام العطل الرسمية وايام الاجازات المرضية الواقعة خلالها ويستحق العامل اجازة عن كسور السنة بنسبة ماقضاه منها في العمل ولو كانت السنة الاولي من الخدمة ( مادة 73 للعامل الحق في الحصول علي مقابل نقدى لايام اجازاته السنوية المجمعة في حالة انتهاء عقده)">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>بدل فترة انزار</label>
                                <div class="row" data-plugin-tooltip data-toggle="tooltip" data-placement="top" title="مادة 44 اذا كان عقد العمل غير محدد المدة جاز لكل من طرفية انهاؤه بعد اخطار الطرف الاخر ويكون الاخطار على الوجه الاتى أ/ قبل انهاء العقد بثلاثة اشهر على الأقل بالنسبة للعمال المعينين باجر شهري. ب/ قبل لنتهاء العقد بشهر على الأقل بالنسبة للعمال الاخرين فاذا لم يراع الطرف الذي انهى العقد مدة الاخطار فانه يلتزم بان يدفع للطرف الاخر بدل مهلة الاخطار مساوية لاجر العامل عن نفس المدة لصاحب العمل ان يعفى العامل عن العمل اثناء مهلة الاخطار مع احتساب مدة خدمة العامل مستمرة الى حين انتهاء تلك المهلة مع ما يترتب علي ذالك من اثار وبخاصة استحقاق العامل اجره عن مهلة الاخطار">
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" placeholder="شهور">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" placeholder="أيام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>اجور متاخرة</label>
                                <div class="row" data-plugin-tooltip data-toggle="tooltip" data-placement="top" title="مادة 55 يقصد بالاجر مايتقاضاه العامل من اجر أساسي مضافا الية ما يتقاضاه عادة من علاوات ومكافات او عمولات او منح او هبات دورية او مزايا نقدية واذا حدد الاجر بمقدار حصة من صافى الأرباح ولم تحقق المنشاة ربحا او حققت ربحا ضئيلا بحيث لا تتناسب حصة العامل مع العمل الذى قام به يجب تقدير اجرة المثل او وفقا لعرف   المهنة او لمقتضيات العدالة - ويراعي في احتساب الاجر اخر اجر تقاضاه العامل 2 مادة 62 الاجر الذى يعول علية عند حساب ما يستحقه العامل من مكافاة نهاية الخدمة هو اخر اجر تقاضاه ويدخل فية كل ما يعطى للعامل مقابل العمل الذى يؤدية متى اخذ شكل الاعتياد فاذا كان العامل ممن يتقاضون اجورهم بالقطعة يحدد اجره بمتوسط ما تقاضاه خلال ايام العمل الفعلية في الاشهر الثلاثة الاخيرة ويكون تقدير المزايا النقدية والعينية بتقييم متوسط ماتقاضاه العامل منها خلال الاثنى عشر شهرا الاخيرة على الاستحقاق فاذا قلت مدة خدمتة عن سنة حسب المتوسط على نسبة ما امضاه منها في الخدمة ولا يجوز تخفيض اجر العامل خلال مدة عقده لاى سشبب من الاسباب (مادة 28 )  ">
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" placeholder="شهور">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" placeholder="أيام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>بدل الراحة الاسبوعية</label>
                                <div class="row" data-plugin-tooltip data-toggle="tooltip" data-placement="top" title="مادة 67 للعامل الحق في راحة أسبوعية مدفوعة الاجر ويجوز تشغيل العامل يوم راحتة الأسبوعية ويتقاضى 50؟% على الأقل من اجره إضافة لاجره الأصلي ويعوض راحتة بيوم راحة اخر ولا يخل حكم الفقرة السابقة في حساب حق العامل بما فيها اجره اليومي واجازاته حيث يجري حساب هذا الحق بقسمة راتبة علي عدد ايام العمل الفعلية دون ان يحسب من ضمنها ايام راحته الاسبوعية على الرغم من كون ايام الراحة هذه مدفوعة الاجر">
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" placeholder="أيام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>بدل ساعات العمل الاضافية</label>
                                <div class="row" data-plugin-tooltip data-toggle="tooltip" data-placement="top" title="مادة 66 يحق للعامل ان يحصل علي اجر عن فترة العمل الإضافي يزيد علي اجره العادى في الفترة المماثلة بمقدار 25%">
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" placeholder="ساعات">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>بدل الأعياد والعطل الرسمية</label>
                                <div class="row" data-plugin-tooltip data-toggle="tooltip" data-placement="top" title="مادة 68 الاجازات الرسمية المقررة للعامل باجر كامل هي ا-يوم راس السنة الهجرية يوم واحد ب-يوم الاسراء والمعراج يوم واحد ج-عيد الفطر ثلاثة أيام د-وقفة عيد الأضحى يوم واحد ه-عيد الأضحى المبارك ثلاثة أيام و-المولد النبوى الشريف يوم واحد ز- العيد الوطني يوم واحد ح- يوم التحرير يوم واحد ط-راس السنة الميلادية يوم واحد اذا جرى تشغيل العامل فى احد هذه الايام قرر له اجر مضاعف عنه مع تعويضه بيوم بديل ">
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" placeholder="ايام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>بدل اعياد تصادف راحة اسبوعية</label>
                                <div class="row" data-plugin-tooltip data-toggle="tooltip" data-placement="top" title="مادة 68 الاجازات الرسمية المقررة للعامل باجر كامل هي ا-يوم راس السنة الهجرية يوم واحد ب-يوم الاسراء والمعراج يوم واحد ج-عيد الفطر ثلاثة أيام د-وقفة عيد الأضحى يوم واحد ه-عيد الأضحى المبارك ثلاثة أيام و-المولد النبوى الشريف يوم واحد ز- العيد الوطني يوم واحد ح- يوم التحرير يوم واحد ط-راس السنة الميلادية يوم واحد اذا جرى تشغيل العامل فى احد هذه الايام قرر له اجر مضاعف عنه مع تعويضه بيوم بديل">
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" placeholder="ايام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label> اجمالى أيام المرضى</label>
                                <input type="number" value="" max="45" class="form-control" name="" id="" required data-plugin-tooltip data-toggle="tooltip" data-placement="top" title="مادة 69 للعامل الحق في الاجازات المرضية الاتية خلال السنة اذا اثبت المرض بشهادة من الطبيب الذى يعينة صاحب العمل او الطبيب المسئول في الوحدة الصحية الحكومية ويعتد بالشهادة الأخيرة في حالة وقوع خلاف بيب الشادتين 1 - خمسة عشر يوما باجر كامل 2 - عشر أيام بثلاثة ارباع الاجر 3 - عشر ايام بنصف الاجر 4 - عشر ايام بربع الاجر 5 - ثلاثون يوما بدون اجر">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>أجور مدة العلاج - بالاجر كامل</label>
                                <div class="row" data-plugin-tooltip data-toggle="tooltip" data-placement="top" title="مادة 93 للعامل المصاب بإصابة عمل او مرض مهني الحق في تقاضي اجره طوال فترة العلاج التي يحددها الطبيب واذا زادت فترة العلاج على ستة اشهر يدفع له نصف الاجر فقط حتى شفاؤه او تثبت عاهتة او يتوفي">
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" placeholder="شهور">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" placeholder="أيام">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <label>أجور مدة العلاج -  بنصف الاجر</label>
                                <div class="row" data-plugin-tooltip data-toggle="tooltip" data-placement="top" title="مادة 93 للعامل المصاب بإصابة عمل او مرض مهني الحق في تقاضي اجره طوال فترة العلاج التي يحددها الطبيب واذا زادت فترة العلاج على ستة اشهر يدفع له نصف الاجر فقط حتى شفاؤه او تثبت عاهتة او يتوفي">
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" placeholder="شهور">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" placeholder="أيام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>تعويض عن إصابة العمل</label>
                                <div class="row" data-plugin-tooltip data-toggle="tooltip" data-placement="top" title="مادة 94 للعامل المصاب او المستحقين عنه الحق في التعويض عن إصابة العمل او امراض المهنة طبقا للجدول الذى يصدر بقرار من الوزير ولم يصدر بعد هذا القرار ويعمل بقرار وزير الشئون الاجتماعية والعمل رقم 1998/120 والذى جاء قيد يكون التعويض للعامل في حالة الوفاة هو اجر كامل عن 1500 يوم او قيمة الدية الشرعية ايهما اكبر وتزداد نسبة التعويض في حالة العجز الدائم الكلي الي اجر كامل عن 2000 يوما او ما يعادل مرة وثلث الدية الشرعية ايهما اكبر اما في حالة العجز الجزئى الدائم فيحتسب التعويض عنه بما يعادل النسبة المقررة لذلك العجز من قيمة التعويض عن العجز الكلي الدائم">
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" placeholder="ايام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>العجز الدائم الكلى</label>
                                <div class="row" data-plugin-tooltip data-toggle="tooltip" data-placement="top" title="مادة 93 للعامل المصاب بإصابة عمل او مرض مهني الحق في تقاضي اجره طوال فترة العلاج التي يحددها الطبيب واذا زادت فترة العلاج على ستة اشهر يدفع لة نصف الاجر فقط حتى شفاؤه او تثبت عاهته او يتوفى">
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" placeholder="ايام">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>العجز الجزئى</label>
                                <div class="row" data-plugin-tooltip data-toggle="tooltip" data-placement="top" title="مادة 93 للعامل المصاب بإصابة عمل او مرض مهني الحق في تقاضي اجره طوال فترة العلاج التي يحددها الطبيب واذا زادت فترة العلاج على ستة اشهر يدفع لة نصف الاجر فقط حتى شفاؤه او تثبت عاهته او يتوفى">
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" placeholder="ايام">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <label>مستحقات إجازة الوضع</label>
                                <div class="row" data-plugin-tooltip data-toggle="tooltip" data-placement="top" title="مادة 93 للعامل المصاب بإصابة عمل او مرض مهني الحق في تقاضي اجره طوال فترة العلاج التي يحددها الطبيب واذا زادت فترة العلاج على ستة اشهر يدفع له نصف الاجر فقط حتى شفاؤه او تثبت عاهتة او يتوفي">
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" placeholder="شهور">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" placeholder="أيام">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label>مستحقات إجازة عدة</label>
                                <div class="row" data-plugin-tooltip data-toggle="tooltip" data-placement="top" title="مادة 3.2/77 للمراة العاملة المسلمة التي يتوفي زوجها الحق في إجازة عدة باجر كامل لمدة أربعة اشهر وعشرة أيام من تاريخ الوفاة كما تمنح المراة العاملة غير المسلمة المتوفي عنها زوجها إجازة لمدة واحد وعشرون يوما مدفوعة الاجر">
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" placeholder="شهور">
                                    </div>
                                    <div class="visible-xs mb-md"></div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" placeholder="أيام">
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

            <div class="col-md-3">
                <aside class="sidebar">

                    <ul class="nav nav-list mb-xl show-bg-active">
                        <li><a href="#">خدمه 1</a></li>
                        <li><a href="#">خدمه 1</a></li>
                        <li class="active"><a href="#">خدمه 2 </a></li>
                        <li><a href="#">خدمه 3</a></li>
                        <li><a href="#">خدمه 4</a></li>
                    </ul>

                </aside>

            </div>
        </div>

    </div>
    <hr class="tall">

</div>

<?php include 'footer.php' ?>
