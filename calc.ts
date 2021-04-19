export const calc = (val: any) => {
    let { maternityLeaveMonths2, maternityLeaveDays2, maternityLeaveMonths, maternityLeaveDays, partialDisability, TotalDisability, dead, inCase, workInjuryMonths, workInjuryDays, sickDays, daysForVacation2, daysForVacation, workHours, additionHours, weeklyRest, delaySeleryMonths, delaySeleryDays, noticePeriodMonths, noticePeriodDays, startWork, endWork, discountDaysFromEnd, discountDaysBefore20, discountDaysAfter20, vacationDaysPaid, selery, seleryPlus, endReason, additionVacation, discountInsurance } = val

    // حساب تاريخ مستحقات مكافاة نهاية الخدمة
    let endDateAward = (startDate:any, endData:any, discountDaysFromEnd = 0, selery:any, seleryPlus = 0, endReason:any, discountInsurance = 0) => {
        // var now = new Date('12/31/2020');
        // console.log(selery, endReason, seleryPlus, discountDaysFromEnd, endData, startDate)
        var now:any = new Date(endData);
        var today = new Date(now.getYear(), now.getMonth(), now.getDate());

        var yearNow = now.getYear();
        var monthNow = now.getMonth();
        var dateNow = now.getDate();
        var fullYearNow = now.getFullYear()

        var dob:any = new Date(startDate.substring(6, 10),
            startDate.substring(0, 2) - 1,
            startDate.substring(3, 5)
        );

        var yearDob = dob.getYear();
        var monthDob = dob.getMonth();
        var dateDob = dob.getDate();
        var fullYearDob = dob.getFullYear()

        var age = {};
        let totalDays_StartWork = (yearDob * 12 * 30) + (monthDob * 30) + (dateDob);
        let totalDays_EndWork = (yearNow * 12 * 30) + (monthNow * 30) + (dateNow);

        let tolalDays = totalDays_EndWork - totalDays_StartWork - discountDaysFromEnd + 1;

        // console.log(totalDays_StartWork, totalDays_EndWork, tolalDays)


        let defaultDaysInYear = 360;
        let years = 1;
        while (defaultDaysInYear < tolalDays) {
            years++;
            defaultDaysInYear = 360 * years;
        }

        // console.log(years, defaultDaysInYear)

        let daysInMonth = 0;
        let defaultDaysInMonth = 30;

        if (defaultDaysInYear > tolalDays) {
            years--
            defaultDaysInYear = 360 * years;
            daysInMonth = Math.abs(defaultDaysInYear - tolalDays);
        }

        // console.log(years, daysInMonth, defaultDaysInMonth)

        let month = 1;
        while (defaultDaysInMonth < daysInMonth) {
            month++;
            defaultDaysInMonth = 30 * month;
        }

        // console.log(defaultDaysInMonth , month)

        let days = 0;
        if (defaultDaysInMonth > daysInMonth) {
            month--
            defaultDaysInMonth = 30 * month;
            days = Math.abs(defaultDaysInMonth - daysInMonth);
        }

        // console.log(days, month, defaultDaysInMonth)

        age = {
            years,
            month,
            days
        };

        console.log(age)

        // check if he spent more than 5 your before this data
        let spentMoreThan_5_years = years > 5 ? years - 5 : false;

        let totalSelery = +selery + +seleryPlus;

        let calcYearsAmount = 0;
        let calcMonthAmount = 0;
        let calcdaysAmount = 0;
        let first_5_years = 0;
        let last_5_years = 0;
        let totalFirst_5_years = 0;
        let totalLast_5_years = 0;
        if (spentMoreThan_5_years) {
            calcYearsAmount += 5 * (totalSelery / 26) * 15;
            calcMonthAmount += (month / 12) * totalSelery;
            calcdaysAmount += (days / 365) * totalSelery;
            
            // total amount for first 5 years
            first_5_years = calcYearsAmount;
            // total amount for after 5 years
            last_5_years = spentMoreThan_5_years * totalSelery;
            
            totalFirst_5_years = calcYearsAmount;

            calcYearsAmount += spentMoreThan_5_years * totalSelery;
            
            totalLast_5_years = calcYearsAmount + calcMonthAmount + calcdaysAmount;


        } else {
            calcYearsAmount += years * (totalSelery / 26) * 15;

            calcMonthAmount += (month / 12) * (totalSelery / 26) * 15;

            calcdaysAmount += (days / 360) * (totalSelery / 26) * 15;

            first_5_years = years * (totalSelery / 26) * 15;
            totalFirst_5_years = calcYearsAmount + calcMonthAmount + calcdaysAmount;
        }

        // console.log(calcYearsAmount, calcMonthAmount, calcdaysAmount);

        let totalAmount:any = calcYearsAmount + calcMonthAmount + calcdaysAmount;
        let finalAwardAmount:any = 0;

        // اذ كان السبب يعود للمدعى عليه
        if (endReason == 2) {
            return {
                age: {
                    title: `المده المستحق`,
                    val: age
                },
                totalAmount: {
                    title: `الاجمالى`,
                    total: totalAmount.toFixed(3)
                },
                finalAwardAmount: {
                    title: `الاجمالى بعد معرفه مده العمل وسبب نهايه الخدمه`,
                    total: totalAmount.toFixed(3),
                },
                finalAmount: {
                    title: `صافى مكافاة نهاية الخدمة بعد خصم التامينات`,
                    total: totalAmount.toFixed(3) - discountInsurance
                },
                tableData: {
                    startWork: {
                        years: fullYearDob,
                        month: +monthDob + 1,
                        days: dateDob
                    },
                    endWork: {
                        years: fullYearNow,
                        month: +monthNow + 1,
                        days: dateNow
                    },
                    discountDaysFromEnd,
                    workDate: {
                        ...age
                    },
                    first_5_years: first_5_years.toFixed(3),
                    last_5_years: last_5_years.toFixed(3),
                    calcMonthAmount: calcMonthAmount.toFixed(3),
                    calcdaysAmount: calcdaysAmount.toFixed(3),
                    totalFirst_5_years: totalFirst_5_years.toFixed(3),
                    totalLast_5_years: totalLast_5_years.toFixed(3),
                    spentMoreThan_5_years
                },
                reason: `يستحق المدعي اجمالي قيمة مكافاة نهاية الخدمة اذا كانت سبب نهاية الخدمة يعود للمدعى عليها او اذا تجاوزت مدة خدمته 10 سنوات وبحد اقصى راتب سنة ونصف `
            }
        }

        // اذ كان السبب يعود للمدعى وعدد سنوات العمل اقل من 3 سنوات
        if (endReason == 1 && years < 3) {
            return {
                age: {
                    title: `المده المستحق`,
                    val: age
                },
                totalAmount: {
                    title: `الاجمالى`,
                    total: totalAmount.toFixed(3)
                },
                finalAwardAmount: {
                    title: `الاجمالى بعد معرفه مده العمل وسبب نهايه الخدمه`,
                    total: finalAwardAmount.toFixed(3)
                },
                finalAmount: {
                    title: `صافى مكافاة نهاية الخدمة بعد خصم التامينات`,
                    total: finalAwardAmount.toFixed(3) - discountInsurance
                },
                tableData: {
                    startWork: {
                        years: fullYearDob,
                        month: +monthDob + 1,
                        days: dateDob
                    },
                    endWork: {
                        years: fullYearNow,
                        month: +monthNow + 1,
                        days: dateNow
                    },
                    discountDaysFromEnd,
                    workDate: {
                        ...age
                    },
                    first_5_years: first_5_years.toFixed(3),
                    last_5_years: last_5_years.toFixed(3),
                    calcMonthAmount: calcMonthAmount.toFixed(3),
                    calcdaysAmount: calcdaysAmount.toFixed(3),
                    totalFirst_5_years: totalFirst_5_years.toFixed(3),
                    totalLast_5_years: totalLast_5_years.toFixed(3),
                    spentMoreThan_5_years
                },
                reason: ` اذا كانت خدمة المدعي اقل من 3 سنوات و سبب نهاية الخدمة يعود للمدعي فانه لا يستحق مكافاة نهاية الخدمة`
            }
        }

        // اذا كان السبب يعود للمدعى وعدد سنوات العمل  اكبر من 3 سنوات واقل من 5 سنوات
        if (endReason == 1 && years >= 3 && years < 5) {
            return {
                age: {
                    title: `المده المستحق`,
                    val: age
                },
                totalAmount: {
                    title: `الاجمالى`,
                    total: totalAmount.toFixed(3)
                },
                finalAwardAmount: {
                    title: `الاجمالى بعد معرفه مده العمل وسبب نهايه الخدمه`,
                    total: (totalAmount / 2).toFixed(3)
                },
                finalAmount: {
                    title: `صافى مكافاة نهاية الخدمة بعد خصم التامينات`,
                    total: ((totalAmount / 2).toFixed(3) as any) - discountInsurance
                },
                tableData: {
                    startWork: {
                        years: fullYearDob,
                        month: +monthDob + 1,
                        days: dateDob
                    },
                    endWork: {
                        years: fullYearNow,
                        month: +monthNow + 1,
                        days: dateNow
                    },
                    discountDaysFromEnd,
                    workDate: {
                        ...age
                    },
                    first_5_years: first_5_years.toFixed(3),
                    last_5_years: last_5_years.toFixed(3),
                    calcMonthAmount: calcMonthAmount.toFixed(3),
                    calcdaysAmount: calcdaysAmount.toFixed(3),
                    totalFirst_5_years: totalFirst_5_years.toFixed(3),
                    totalLast_5_years: totalLast_5_years.toFixed(3),
                    spentMoreThan_5_years
                },
                reason: `بما ان خدمة المدعي اقل من 5 سنوات واكثر من 3 سنوات وسبب نهاية الخدمة يعود للمدعي فانه يستحق نصف كافاة نهاية الخدمة `
            }
        }

        // اذا كان السبب يعود للمدعى وعدد سنوات العمل  اكبر من 5 سنوات واقل من 10 سنوات
        if (endReason == 1 && years >= 5 && years < 10) {
            return {
                age: {
                    title: `المده المستحق`,
                    val: age
                },
                totalAmount: {
                    title: `الاجمالى`,
                    total: totalAmount.toFixed(3)
                },
                finalAwardAmount: {
                    title: `الاجمالى بعد معرفه مده العمل وسبب نهايه الخدمه`,
                    total: ((totalAmount / 3) * 2).toFixed(3)
                },
                finalAmount: {
                    title: `صافى مكافاة نهاية الخدمة بعد خصم التامينات`,
                    total: (((totalAmount / 3) * 2).toFixed(3) as any) - discountInsurance
                },
                tableData: {
                    startWork: {
                        years: fullYearDob,
                        month: +monthDob + 1,
                        days: dateDob
                    },
                    endWork: {
                        years: fullYearNow,
                        month: +monthNow + 1,
                        days: dateNow
                    },
                    discountDaysFromEnd,
                    workDate: {
                        ...age
                    },
                    first_5_years: first_5_years.toFixed(3),
                    last_5_years: last_5_years.toFixed(3),
                    calcMonthAmount: calcMonthAmount.toFixed(3),
                    calcdaysAmount: calcdaysAmount.toFixed(3),
                    totalFirst_5_years: totalFirst_5_years.toFixed(3),
                    totalLast_5_years: totalLast_5_years.toFixed(3),
                    spentMoreThan_5_years
                },
                reason: `بما ان خدمة المدعي اكثر من 5 سنوات واقل من 10 سنوات وسبب نهاية الخدمة يعود للمدعي فانه يستحق ثلثي مكافاة نهاية الخدمة `
            }
        }

        // اذا كان السبب يعود للمدعى وعدد سنوات العمل  اكبر من 10 سنوات
        if (endReason == 1 && years >= 10) {
            return {
                age: {
                    title: `المده المستحق`,
                    val: age
                },
                totalAmount: {
                    title: `الاجمالى`,
                    total: totalAmount.toFixed(3)
                },
                finalAwardAmount: {
                    title: `الاجمالى بعد معرفه مده العمل وسبب نهايه الخدمه`,
                    total: totalAmount.toFixed(3)
                },
                finalAmount: {
                    title: `صافى مكافاة نهاية الخدمة بعد خصم التامينات`,
                    total: totalAmount.toFixed(3) - discountInsurance
                },
                tableData: {
                    startWork: {
                        years: fullYearDob,
                        month: +monthDob + 1,
                        days: dateDob
                    },
                    endWork: {
                        years: fullYearNow,
                        month: +monthNow + 1,
                        days: dateNow
                    },
                    discountDaysFromEnd,
                    workDate: {
                        ...age
                    },
                    first_5_years: first_5_years.toFixed(3),
                    last_5_years: last_5_years.toFixed(3),
                    calcMonthAmount: calcMonthAmount.toFixed(3),
                    calcdaysAmount: calcdaysAmount.toFixed(3),
                    totalFirst_5_years: totalFirst_5_years.toFixed(3),
                    totalLast_5_years: totalLast_5_years.toFixed(3),
                    spentMoreThan_5_years
                },
                reason: `يستحق المدعي اجمالي قيمة مكافاة نهاية الخدمة اذا كانت سبب نهاية الخدمة يعود للمدعى عليها او اذا تجاوزت مدة خدمته 10 سنوات وبحد اقصى راتب سنة ونصف `
            }
        }

    }

    // حساب رصيد الاجازات
    let calcLawDate = (startDate:any, endDate:any, discountDaysBefore20 = 0, discountDaysAfter20 = 0, vacationDaysPaid = 0, selery:any, additionVacation = 30) => {

        let daysBefore20:any = false;
        let daysAfter20:any = false;
        let date_20_02_2010 = '02/20/2010';

        //  على القانون القديم
        if (new Date(date_20_02_2010).getTime() > new Date(startDate).getTime()) {

            var now:any = new Date(date_20_02_2010);
            var today = new Date(now.getYear(), now.getMonth(), now.getDate());

            var yearNow = now.getYear();
            var monthNow = now.getMonth();
            var dateNow = now.getDate();
            var fullYearNow = now.getFullYear()

            var dob:any = new Date(startDate.substring(6, 10),
                startDate.substring(0, 2) - 1,
                startDate.substring(3, 5)
            );

            var yearDob = dob.getYear();
            var monthDob = dob.getMonth();
            var dateDob = dob.getDate();
            var fullYearDob = dob.getFullYear()

            var age = {};

            let totalDays_StartWork = (yearDob * 12 * 30) + (monthDob * 30) + (dateDob);
            let totalDays_EndWork = (yearNow * 12 * 30) + (monthNow * 30) + (dateNow);

            let tolalDays = totalDays_EndWork - totalDays_StartWork - discountDaysBefore20 + 1;

            // console.log(totalDays_StartWork, totalDays_EndWork, tolalDays)


            let defaultDaysInYear = 360;
            let years = 1;
            while (defaultDaysInYear < tolalDays) {
                years++;
                defaultDaysInYear = 360 * years;
            }

            // console.log(years, defaultDaysInYear)

            let daysInMonth = 0;
            let defaultDaysInMonth = 30;

            if (defaultDaysInYear > tolalDays) {
                years--
                defaultDaysInYear = 360 * years;
                daysInMonth = Math.abs(defaultDaysInYear - tolalDays);
            }

            // console.log(years, daysInMonth, defaultDaysInMonth)

            let month = 1;
            while (defaultDaysInMonth < daysInMonth) {
                month++;
                defaultDaysInMonth = 30 * month;
            }

            // console.log(defaultDaysInMonth , month)

            let days = 0;
            if (defaultDaysInMonth > daysInMonth) {
                month--
                defaultDaysInMonth = 30 * month;
                days = Math.abs(defaultDaysInMonth - daysInMonth);
            }

            // console.log(days, month, defaultDaysInMonth)

            age = {
                years,
                month,
                days
            };

            console.log(age)
            // 

            // عدد الايام طبقا للقانون القديم

            // check if he spent more than 5 your before this data
            let spentMoreThan_5_years = years > 5 ? years - 5 : false;
            let TotalFirst_5_years = 0;
            let TotalAfterFirst_5_years = 0;

            let calcYears = 0;
            if (spentMoreThan_5_years) {
                calcYears += 5 * 14;
                calcYears += spentMoreThan_5_years * 21;

                TotalFirst_5_years = 5 * 14;
                TotalAfterFirst_5_years = spentMoreThan_5_years * 21;
            } else {
                calcYears += years * 14;
                TotalFirst_5_years = years * 14;
            }

            let calcMonth = spentMoreThan_5_years ? (month / 12) * 21 : (month / 12) * 14;
            let calcdays = spentMoreThan_5_years ? (days / 365) * 21 : (days / 365) * 14;

            let totalDays = calcdays + calcMonth + calcYears;

            let date = {
                inYear: calcYears.toFixed(3),
                inMonth: calcMonth.toFixed(3),
                inDays: calcdays.toFixed(3),
                totalDays: totalDays.toFixed(3)
            }

            // console.log(calcYears);

            daysBefore20 = {
                dateBefore20_2: age,
                spentMoreThan_5_years,
                before20_2: true,
                date,
                tableData: {
                    startWork: {
                        years: fullYearDob,
                        month: +monthDob + 1,
                        days: dateDob
                    },
                    endWork: {
                        years: fullYearNow,
                        month: +monthNow + 1,
                        days: dateNow
                    },
                    discountDaysBefore20,
                    TotalFirst_5_years: TotalFirst_5_years.toFixed(3),
                    TotalAfterFirst_5_years: TotalAfterFirst_5_years.toFixed(3),
                    workDate: {
                        ...age
                    }
                }
            }

        }

        //  على القانون الجديد
        if (new Date(date_20_02_2010).getTime() < new Date(endDate).getTime()) {

            var now:any = new Date(endDate);
            var today = new Date(now.getYear(), now.getMonth(), now.getDate());

            var yearNow = now.getYear();
            var monthNow = now.getMonth();
            var dateNow = now.getDate();
            var fullYearNow = now.getFullYear()

            var dob:any = daysBefore20 ? new Date((date_20_02_2010.substring(6, 10) as any),
                (date_20_02_2010.substring(0, 2) as any) - 1,
                (date_20_02_2010.substring(3, 5) as any)
            ) : new Date(startDate.substring(6, 10),
                startDate.substring(0, 2) - 1,
                startDate.substring(3, 5)
            )

            var yearDob = dob.getYear();
            var monthDob = dob.getMonth();
            var dateDob = dob.getDate();
            var fullYearDob = dob.getFullYear()
            var age = {};

            let totalDays_StartWork = (yearDob * 12 * 30) + (monthDob * 30) + (dateDob);
            let totalDays_EndWork = (yearNow * 12 * 30) + (monthNow * 30) + (dateNow);

            let tolalDays = totalDays_EndWork - totalDays_StartWork - discountDaysAfter20 + 1;

            // console.log(totalDays_StartWork, totalDays_EndWork, tolalDays)


            let defaultDaysInYear = 360;
            let years = 1;
            while (defaultDaysInYear < tolalDays) {
                years++;
                defaultDaysInYear = 360 * years;
            }

            // console.log(years, defaultDaysInYear)

            let daysInMonth = 0;
            let defaultDaysInMonth = 30;

            if (defaultDaysInYear > tolalDays) {
                years--
                defaultDaysInYear = 360 * years;
                daysInMonth = Math.abs(defaultDaysInYear - tolalDays);
            }

            // console.log(years, daysInMonth, defaultDaysInMonth)

            let month = 1;
            while (defaultDaysInMonth < daysInMonth) {
                month++;
                defaultDaysInMonth = 30 * month;
            }

            // console.log(defaultDaysInMonth , month)

            let days = 0;
            if (defaultDaysInMonth > daysInMonth) {
                month--
                defaultDaysInMonth = 30 * month;
                days = Math.abs(defaultDaysInMonth - daysInMonth);
            }

            // console.log(days, month, defaultDaysInMonth)

            age = {
                years,
                month,
                days
            };

            console.log(age)
            // عدد الايام طبقا للقانون الجديد


            let calcYears = years * additionVacation
            let calcMonth = (month / 12) * additionVacation;
            let calcdays = (days / 365) * additionVacation;

            let totalDays = calcdays + calcMonth + calcYears;

            let date = {
                inYear: calcYears.toFixed(3),
                inMonth: calcMonth.toFixed(3),
                inDays: calcdays.toFixed(3),
                totalDays: totalDays.toFixed(3)
            }

            // console.log(calcYears);

            daysAfter20 = {
                dateAfter20_2: age,
                after20_2: true,
                date,
                tableData: {
                    startWork: {
                        years: fullYearDob,
                        month: +monthDob + 1,
                        days: dateDob
                    },
                    endWork: {
                        years: fullYearNow,
                        month: +monthNow + 1,
                        days: dateNow
                    },
                    discountDaysAfter20,
                    additionVacation,
                    workDate: {
                        ...age
                    }
                }
            }

        }

        let totalVacationDays = (daysBefore20?.date?.totalDays || 0) + (daysAfter20?.date?.totalDays || 0);

        let onlyTotalVacationDaysWithOutPaidDays = totalVacationDays - vacationDaysPaid;

        let moneyForAnnualVacation = (selery / 26) * onlyTotalVacationDaysWithOutPaidDays;

        return {
            daysBefore20: {
                title: `الايام قبل 20-2`,
                val: daysBefore20
            },
            daysAfter20: {
                title: `2-الايام بعد 20`,
                val: daysAfter20
            },
            totalVacationDays: {
                title: `اجمالي عدد الاجازات`,
                val: totalVacationDays
            },
            onlyTotalVacationDaysWithOutPaidDays: {
                title: `اجمالي عدد الاجازات بعد خصم الايام مدفوعه الاجر`,
                val: onlyTotalVacationDaysWithOutPaidDays,
                vacationDaysPaid
            },
            moneyForAnnualVacation: {
                title: `مستحقات الاجازات السنوية`,
                total: moneyForAnnualVacation.toFixed(3)
            },
            selery
        }

    }

    let calc_noticePeriod = (noticePeriodDays = 0, noticePeriodMonths = 0) => {
        let calcDays = (selery / 26) * noticePeriodDays;
        let calcMonths = selery * noticePeriodMonths;

        return {
            title: `اجمالى المستحق عن فترة الانزار`,
            total: (calcDays + calcMonths).toFixed(3),
            noticePeriodDays,
            noticePeriodMonths,
            calcDays: calcDays.toFixed(3),
            calcMonths
        }
    }

    let calc_delaySelery = (delaySeleryDays = 0, delaySeleryMonths = 0) => {
        let calcDays = (selery / 26) * delaySeleryDays;
        let calcMonths = selery * delaySeleryMonths;

        return {
            title: `اجمالى المستحق من الاجور المتاخرة`,
            total: (calcDays + calcMonths).toFixed(3),
            delaySeleryDays,
            delaySeleryMonths,
            calcDays: calcDays.toFixed(3),
            calcMonths
        }
    }

    let calc_weeklyRest = (weeklyRest = 0) => {
        let calcDays = (((selery / 26) * weeklyRest) / 100) * 150;

        return {
            title: `اجمالى المستحق عن بدل الراحة الاسبوعية`,
            total: (calcDays).toFixed(3),
            weeklyRest,
            calcDays: calcDays.toFixed(3),
        }
    }

    let calc_additionHours = (additionHours = 0, workHours:any) => {
        let calcHours = ((((selery / 26) / workHours) * additionHours) / 100) * 125;

        return {
            title: `اجمالى المستحق عن بدل ساعات العمل الاضافى`,
            total: (calcHours).toFixed(3),
            additionHours,
            workHours,
            calcHours
        }
    }

    let calc_daysForVacation = (daysForVacation = 0) => {
        let calcDays = (selery / 26) * daysForVacation;

        return {
            title: `اجمالى المستحق عن بدل الاعياد`,
            total: (calcDays).toFixed(3),
            daysForVacation,
            calcDays: calcDays.toFixed(3),
        }
    }

    let calc_daysForVacation2 = (daysForVacation2 = 0) => {
        let calcDays = (((selery / 26) * daysForVacation2) / 100) * 200;

        return {
            title: `اجمالى المستحق عن بدل الاعياد التى تصادف راحة اسبوعية`,
            total: (calcDays).toFixed(3),
            calcDays: calcDays.toFixed(3),
            daysForVacation2
        }
    }

    let calc_sickDays = (sickDays = 0) => {
        let ifMoreThan_100_days = sickDays > 15 ? 15 : sickDays;

        let ifMoreThan_75_days = Math.abs(ifMoreThan_100_days - sickDays) > 10 ? 10 : Math.abs(ifMoreThan_100_days - sickDays);

        let ifMoreThan_50_days = Math.abs((ifMoreThan_75_days + ifMoreThan_100_days) - sickDays) > 10 ? 10 : Math.abs((ifMoreThan_75_days + ifMoreThan_100_days) - sickDays);

        let ifMoreThan_25_days = Math.abs((ifMoreThan_50_days + ifMoreThan_75_days + ifMoreThan_100_days) - sickDays);

        let calcDays_100 = (((selery / 26) * ifMoreThan_100_days) / 100) * 100;
        let calcDays_75 = (((selery / 26) * ifMoreThan_75_days) / 100) * 75;
        let calcDays_50 = (((selery / 26) * ifMoreThan_50_days) / 100) * 50;
        let calcDays_25 = (((selery / 26) * ifMoreThan_25_days) / 100) * 25;

        return {
            "calcDays_100": {
                title: `اجمالى المستحق عن الأيام المرضى باجر كامل`,
                total: (calcDays_100).toFixed(3),
                ifMoreThan_100_days
            },
            "calcDays_75": {
                title: `اجمالى المستحق عن الأيام المرضى بثلاثة ارباع الاجر`,
                total: (calcDays_75).toFixed(3),
                ifMoreThan_75_days
            },
            "calcDays_50": {
                title: `اجمالى المستحق عن الأيام المرضى بنصف الاجر`,
                total: (calcDays_50).toFixed(3),
                ifMoreThan_50_days
            },
            "calcDays_25": {
                title: `اجمالى المستحق عن الأيام المرضى بربع الاجر`,
                total: (calcDays_25).toFixed(3),
                ifMoreThan_25_days
            },
            sickDays,
            total: (calcDays_25 + calcDays_50 + calcDays_75 + calcDays_100).toFixed(3)
        }
    }

    let calc_workInjury = (workInjuryDays = 0, workInjuryMonths = 0) => {

        let MoreThan_6_Month = workInjuryMonths >= 6 ? workInjuryMonths - 6 : false;

        let calcMonth = 0;
        let calcDays;
        let moneyForFullSalary = 0;
        let moneyForHalfSalary = 0;
        let calcFirstMonth_6 = 0;
        let calcLastMonth_6 = 0;
        let calcFirstDays_6 = 0;

        if (MoreThan_6_Month) {
            calcMonth += (((selery) * 6) / 100) * 100;
            moneyForFullSalary = calcMonth;
            calcFirstMonth_6 = calcMonth;
            calcMonth += (((selery) * MoreThan_6_Month) / 100) * 50;
            calcLastMonth_6 = (((selery) * MoreThan_6_Month) / 100) * 50;
            calcDays = (((selery / 26) * workInjuryDays) / 100) * 50;
            calcFirstDays_6 = calcDays;
            moneyForHalfSalary = Math.abs((calcMonth + calcDays) - moneyForFullSalary);
        } else {
            calcMonth += (((selery) * workInjuryMonths) / 100) * 100;
            calcFirstMonth_6 = calcMonth;
            calcDays = (((selery / 26) * workInjuryDays) / 100) * 100;
            calcFirstDays_6 = calcDays;
            moneyForFullSalary = calcMonth + calcDays;
        }

        return {
            moneyForFullSalary: {
                title: `اجمالى المستحق عن إصابة العمل بالاجر الكامل`,
                total: (moneyForFullSalary).toFixed(3)
            },
            moneyForHalfSalary: {
                title: `اجمالى المستحق عن إصابة العمل بنصف الاجر`,
                total: (moneyForHalfSalary).toFixed(3)
            },
            total: (calcDays + calcMonth).toFixed(3),
            MoreThan_6_Month,
            workInjuryDays,
            workInjuryMonths,
            calcDays: calcDays.toFixed(3),
            calcMonth,
            calcLastMonth_6,
            calcFirstMonth_6,
            calcFirstDays_6
        }
    }

    let calc_inCaseDead = () => {
        let calcDays;
        let fixedVal;
        if (dead == "true") {
            calcDays = (selery / 26) * 1500;
            fixedVal = 10000; // قيمه الديه الشرعيه

            return {
                title: `اجمالى المستحق عن إصابة العمل في حالة الوفاه`,
                total: fixedVal > calcDays ? fixedVal : (calcDays).toFixed(3),
                calcDays: calcDays.toFixed(3),
                fixedVal
            }
        }
        return {
            title: `اجمالى المستحق عن إصابة العمل في حالة الوفاه`,
            total: 0,
            calcDays,
            fixedVal
        }
    }

    let calc_inCaseTotalDisability = () => {
        let calcDays;
        let fixedVal;
        if (TotalDisability == "true") {
            calcDays = (selery / 26) * 2000;
            fixedVal = 13333.33; // قيمه الديه الشرعيه

            return {
                title: `اجمالى المستحق عن العجز الدائم الكلى`,
                total: fixedVal > calcDays ? fixedVal : (calcDays).toFixed(3),
                calcDays: calcDays.toFixed(3),
                fixedVal
            }
        }
        return {
            title: `اجمالى المستحق عن العجز الدائم الكلى`,
            total: 0,
            calcDays,
            fixedVal
        }
    }

    let calc_inCasePartialDisability = () => {
        let calcDays;
        let fixedVal;
        if (partialDisability > 0) {
            calcDays = (((selery / 26) * 2000) / 100) * partialDisability;
            fixedVal = (13333.33 / 100) * partialDisability; // قيمه الديه الشرعيه

            return {
                title: `اجمالى المستحق عن العجز الجزئى`,
                total: fixedVal > calcDays ? fixedVal : (calcDays).toFixed(3),
                calcDays: calcDays.toFixed(3),
                fixedVal,
                partialDisability
            }
        }
        return {
            title: `اجمالى المستحق عن العجز الجزئى`,
            total: 0,
            calcDays,
            fixedVal
        }
    }

    let calc_maternityLeave = (maternityLeaveDays = 0, maternityLeaveMonths = 0) => {
        let calcDays = (selery / 26) * maternityLeaveDays;
        let calcMonths = selery * maternityLeaveMonths;

        return {
            title: `اجمالى المستحق إجازة الوضع`,
            total: (calcDays + calcMonths).toFixed(3),
            calcDays: calcDays.toFixed(3),
            calcMonths,
            maternityLeaveDays,
            maternityLeaveMonths
        }
    }

    let calc_maternityLeave2 = (maternityLeaveDays2 = 0, maternityLeaveMonths2 = 0) => {
        let calcDays = (selery / 26) * maternityLeaveDays2;
        let calcMonths = selery * maternityLeaveMonths2;

        return {
            title: `اجمالى المستحق إجازة عدة`,
            total: (calcDays + calcMonths).toFixed(3),
            calcDays: calcDays.toFixed(3),
            calcMonths,
            maternityLeaveDays2,
            maternityLeaveMonths2
        }
    }

    // // // // //

    let endDateAwardRes = endDateAward(startWork, endWork, discountDaysFromEnd, selery, seleryPlus, endReason, discountInsurance);

    let calcLawDateRes = calcLawDate(startWork, endWork, discountDaysBefore20, discountDaysAfter20, vacationDaysPaid, selery, additionVacation);

    let calc_noticePeriodRes = calc_noticePeriod(noticePeriodDays, noticePeriodMonths);

    let calc_delaySeleryRes = calc_delaySelery(delaySeleryDays, delaySeleryMonths);

    let calc_weeklyRestRes = calc_weeklyRest(weeklyRest);

    let calc_additionHoursRes = calc_additionHours(additionHours, workHours);

    let calc_daysForVacationRes = calc_daysForVacation(daysForVacation);

    let calc_daysForVacation2Res = calc_daysForVacation2(daysForVacation2);

    let calc_sickDaysRes = calc_sickDays(sickDays);

    let calc_workInjuryRes = calc_workInjury(workInjuryDays, workInjuryMonths);

    let calc_inCaseDeadRes = calc_inCaseDead();

    let calc_inCaseTotalDisabilityRes = calc_inCaseTotalDisability();

    let calc_inCasePartialDisabilityRes = calc_inCasePartialDisability();

    let calc_maternityLeaveRes = calc_maternityLeave(maternityLeaveDays, maternityLeaveMonths);

    let calc_maternityLeaveRes2 = calc_maternityLeave2(maternityLeaveDays2, maternityLeaveMonths2);

    let allResult = {
        endDateAwardRes,
        calcLawDateRes,
        calc_noticePeriodRes,
        calc_delaySeleryRes,
        calc_weeklyRestRes,
        calc_additionHoursRes,
        calc_daysForVacationRes,
        calc_daysForVacation2Res,
        calc_sickDaysRes,
        calc_workInjuryRes,
        calc_inCaseDeadRes,
        calc_inCaseTotalDisabilityRes,
        calc_inCasePartialDisabilityRes,
        calc_maternityLeaveRes,
        calc_maternityLeaveRes2,
        selery
    }

    let listOfResult = [
        calc_noticePeriodRes,
        calc_delaySeleryRes,
        calc_weeklyRestRes,
        calc_additionHoursRes,
        calc_daysForVacationRes,
        calc_daysForVacation2Res,
        calc_sickDaysRes.calcDays_100,
        calc_sickDaysRes.calcDays_75,
        calc_sickDaysRes.calcDays_50,
        calc_sickDaysRes.calcDays_25,
        calc_workInjuryRes.moneyForFullSalary,
        calc_workInjuryRes.moneyForHalfSalary,
        calc_inCaseDeadRes,
        calc_inCaseTotalDisabilityRes,
        calc_inCasePartialDisabilityRes,
        calc_maternityLeaveRes,
        calc_maternityLeaveRes2,
        calcLawDateRes.moneyForAnnualVacation
    ];

    console.log(listOfResult)
    return {
        allResult,
        listOfResult
    }

}