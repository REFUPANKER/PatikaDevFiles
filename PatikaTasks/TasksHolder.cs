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
        // for (int i = 0; i < 27; i++)
        // {
        //     Tasks.Add(new Task2(), i + "th task");
        // }
    }

    int listingRange = 5, boundStart = 0, boundEnd = 5;
    void ListTasksWithBoundControl()
    {
        string input = "";
        int? converted = 0;
        while (CanConvertStringToInt(input) == null)
        {
            Console.Clear();
            ListTasksInBounds(boundStart, boundEnd);
            WriteLineColorized(ConsoleColor.Cyan, "Listing : [" + boundStart + "," + (boundEnd) + "] of " + Tasks.Count);
            WriteLineColorized(ConsoleColor.Yellow, "[!] type Task Index or 'e' for exit");
            WriteLineColorized(ConsoleColor.White, "-- << Before (b) = (n) Next >> --");
            input = (ReadLine() + "").ToLower();
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
            if (converted != null && converted >= 0 && converted < Tasks.Count)
            {
                Tasks.ElementAt(((int)converted)).Key.Run();
            }
            else
            {
                WriteLineColorized(ConsoleColor.Red, $"You cant select this Task index : {converted}");
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
}