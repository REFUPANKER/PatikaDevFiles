public class TasksHolder : FastCommands
{
    public TasksHolder()
    {
        cwl("App moved into TaskHolder");
        InitTasks();
        ListTasksWithBoundControl();
    }
    Dictionary<TaskTheme, string> Tasks = new Dictionary<TaskTheme, string>();
    void InitTasks()
    {
        Tasks.Add(new Task1(), "Stringi tersine çevirme");
        Tasks.Add(new Task2(), "Konsola üçgen çizme");
        Tasks.Add(new Task3(), "Konsola daire çizme");
        Tasks.Add(new Task4(), "String içinden girilen noktadaki harfi silme");
        Tasks.Add(new Task5(), "Fibonacci ortalama hesaplama");
        Tasks.Add(new Task6(), "Geometrik şekil işlemleri alan,çevre,hacim vb");
        // for (int i = 0; i < 17; i++)
        // {
        //     Tasks.Add(new Task1(), Tasks.Count + 1 + "th task");
        // }
    }

    int listingRange = 5, boundStart = 0, boundEnd = 5;
    public void ListTasksWithBoundControl()
    {
        string input = "";
        int? converted = 0;
        while (CanConvertStringToInt(input) == null)
        {
            Console.Clear();
            boundEnd = (boundEnd > Tasks.Count) ? (boundEnd - (boundEnd - Tasks.Count)) : boundEnd;
            ListTasksInBounds(boundStart, boundEnd);
            WriteLineColorized(ConsoleColor.Cyan, "Listing : [" + boundStart + "," + (boundEnd) + "] of " + Tasks.Count);
            WriteLineColorized(ConsoleColor.Yellow, "[!] type Task Index or 'e' for exit");
            WriteLineColorized(ConsoleColor.White, "-- << Before (b) = (n) Next >> --");
            input = (ReadLine()).ToLower();
            converted = CanConvertStringToInt(input);
            if (input.StartsWith("e"))
            {
                break;
            }
            if (input.StartsWith("n"))
            {
                if (boundEnd + listingRange > Tasks.Count)
                {

                    boundEnd -= boundEnd - Tasks.Count;
                    boundStart = boundEnd - listingRange;
                    if (boundStart < 0)
                    {
                        boundStart = 0;
                    }
                }
                else
                {
                    boundStart += listingRange;
                    boundEnd = boundStart + listingRange;
                }
            }
            if (input.StartsWith("b"))
            {
                if (boundStart - listingRange < 0)
                {
                    boundStart = 0;
                    boundEnd = boundStart + listingRange;
                }
                else
                {
                    boundEnd = boundStart;
                    boundStart -= listingRange;
                }
            }
            if (converted != null && converted >= 0 && converted <= Tasks.Count)
            {
                Console.Clear();
                converted = (converted == 0) ? 0 : converted - 1;
                KeyValuePair<TaskTheme, string> selectedTask = Tasks.ElementAt(((int)converted));
                TaskRunningNotify(selectedTask.Key.GetType().Name);
                WriteLineColorized(ConsoleColor.DarkCyan, "[</>]" + selectedTask.Value);
                WriteLineColorized(ConsoleColor.Green, "Press enter to continue");
                Console.ReadKey();
                selectedTask.Key.Run();
                WriteLineColorized(ConsoleColor.Yellow, $"{selectedTask.Key.GetType().Name} ended\nPress enter to continue ");
                Console.ReadKey();
                ListTasksWithBoundControl();
            }
            else if (converted < 0 || converted > Tasks.Count)
            {
                WriteLineColorized(ConsoleColor.Red, $"You cant select this Task index : {converted}");
                WriteLineColorized(ConsoleColor.Yellow, "Press enter to continue ");
                Console.ReadKey();
                ListTasksWithBoundControl();
            }
        }
    }
    void ListTasksInBounds(int start, int end, bool writeIndex = false)
    {
        if (start < 0 || end > Tasks.Count)
        {
            WriteLineColorized(ConsoleColor.Yellow, "[!] ListInBound : start or end must between 0 and " + Tasks.Count);
            return;
        }
        if (start > end)
        {
            start += end;
            end = start - end;
            start -= end;
        }
        for (int i = start; i < end; i++)
        {
            if (i < Tasks.Count)
            {
                if (writeIndex)
                {
                    WriteColorized(ConsoleColor.White, i + "\t");
                }
                WriteColorized(ConsoleColor.Green, Tasks.ElementAt(i).Key.GetType().Name);
                WriteColorized(ConsoleColor.White, " > ");
                WriteLineColorized(ConsoleColor.Yellow, Tasks.ElementAt(i).Value);
            }
            else
            {
                break;
            }
        }
    }
    void ListAllTasks()
    {
        foreach (var item in Tasks)
        {
            WriteColorized(ConsoleColor.Green, item.Key.GetType().Name);
            WriteColorized(ConsoleColor.White, " > ");
            WriteLineColorized(ConsoleColor.Yellow, item.Value);
        }
    }
}